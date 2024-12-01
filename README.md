# Danubio IT Services Real Estate API

## Project Overview

This is a Laravel-based REST API for managing real estate properties, developed as part of the Danubio IT Services backend developer take-home assignment. The API allows creating and searching real estate properties with comprehensive filtering capabilities.

## Features

- Create real estate properties (House or Apartment)
- Search properties with multiple filters:
  - Property type
  - Address
  - Size (SQFT or m²)
  - Number of bedrooms
  - Price range
- Geospatial search with radius functionality

## Technical Stack

- **Framework**: Laravel
- **Language**: PHP
- **Database**: MySQL
- **API**: RESTful

## Prerequisites

- PHP 8.0+
- Composer
- MySQL
- Laravel 10

## Installation Steps

1. Clone the repository
```bash
git clone https://github.com/ahmed00078/real-estate-api.git
cd real-estate-api
```

2. Install dependencies
```bash
composer install
```

3. Copy environment file
```bash
cp .env.example .env
```

4. Configure database in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=real-estate-api
DB_USERNAME=your_username(root)
DB_PASSWORD=your_password()
```

5. Generate application key
```bash
php artisan key:generate
```

6. Run migrations
```bash
php artisan migrate
```

7. Start the development server
```bash
php artisan serve
```

## API Endpoints

### Create Property
- **URL**: `POST /api/properties`
- **Payload**:
```json
{
    "type": "House",
    "address": "123 Main St, Cityville",
    "size": 2000,
    "size_unit": "SQFT", 
    "bedrooms": 3,
    "latitude": 40.7128,
    "longitude": -74.0060,
    "price": 500000
}
```

### Search Properties
- **URL**: `GET /api/properties`
- **Query Parameters**:
  - `type`: Filter by property type
  - `address`: Partial address match
  - `min_size` and `max_size`: Size range
  - `bedrooms`: Number of bedrooms
  - `min_price` and `max_price`: Price range

### Search by Location
- **URL**: `GET /api/properties/search-location`
- **Query Parameters**:
  - `latitude`: Latitude of center point
  - `longitude`: Longitude of center point
  - `radius`: Search radius in kilometers (default: 10km)

## Testing

### Run Tests
```bash
php artisan test
```

## Backlog and Future Improvements

1. **Authentication & Authorization**
   - Implement user authentication
   - Add role-based access control
   - Secure API endpoints

2. **Advanced Filtering**
   - Add more complex search filters
   - Implement full-text search for addresses
   - Support more property attributes

3. **Performance Optimization**
   - Implement caching for search results
   - Add database indexing
   - Optimize geospatial queries

4. **Validation Enhancements**
   - More granular input validation
   - Custom validation rules
   - Comprehensive error handling

5. **Reporting & Analytics**
   - Generate property market reports
   - Implement data aggregation endpoints
   - Create dashboard for property insights

6. **Image Upload**
   - Add property image upload functionality
   - Implement image storage and retrieval

7. **Internationalization**
   - Support multiple currencies
   - Add support for international address formats

8. **Webhook Integration**
   - Create webhooks for property updates
   - Integrate with external real estate platforms

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Contact

Danubio IT Services - hello@danub.io(from their website)

Me - ahmedsidimohammed78@gmail.com