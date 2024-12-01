<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'address',
        'size',
        'size_unit',
        'bedrooms',
        'latitude',
        'longitude',
        'price'
    ];

    protected $casts = [
        'size' => 'float',
        'bedrooms' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
        'price' => 'float'
    ];

    // Validation rules for property creation
    public static function validationRules()
    {
        return [
            'type' => ['required', Rule::in(['House', 'Apartment'])],
            'address' => 'required|string|max:255',
            'size' => 'required|numeric|min:0',
            'size_unit' => ['required', Rule::in(['SQFT', 'm2'])],
            'bedrooms' => 'required|integer|min:0',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'price' => 'required|numeric|min:0'
        ];
    }

    // Bonus: Haversine formula for geospatial search
    public static function searchByLocation($latitude, $longitude, $radiusKm = 10)
    {
        $earthRadius = 6371; // Kilometers

        return self::select('*')
            ->selectRaw('( ? * acos( 
                cos( radians(?) ) * 
                cos( radians( latitude ) ) * 
                cos( radians( longitude ) - radians(?) ) + 
                sin( radians(?) ) * 
                sin( radians( latitude ) ) 
            ) ) AS distance', [$earthRadius, $latitude, $longitude, $latitude])
            ->havingRaw('distance <= ?', [$radiusKm])
            ->orderBy('distance')
            ->get();
    }
}