## Product Caching Strategy

### Overview

This Laravel 12 application demonstrates the implementation of caching strategies to optimize product data retrieval. It compares three approaches: no caching, file-based caching, and Redis caching, showcasing performance improvements for a large product dataset.

### Features

- Displays product listings with three different retrieval methods:
  - No caching (direct database query)
  - File-based caching
  - Redis caching
- Performance metrics for each retrieval method.
- Cache clearing functionality.
- Simulated large dataset with 10000 products.
- Responsive UI using Blade templates

### Requirements

- PHP >= 8.2
- Composer
- Laravel 12
- MySQL
- Redis server
- Laravel Debugbar (for query testing)
- Node.js and NPM (for frontend assets)

### Installation

1. Clone the Repository

```bash
    git clone <repository-url>
    cd product-caching
```
2. Install PHP Dependencies

```bash
    composer install
```
3. Install JavaScript Dependencies

```bash
    npm install
```
4. Set Up Environment
- Copy the .env.example file to .env:

```bash
    cp .env.example .env
```
- Generate an application key:
```bash
    php artisan key:generate
```
- Update .env with your database and Redis credentials:
```base
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3307
    DB_DATABASE=caching_strategy
    DB_USERNAME=root
    DB_PASSWORD=
    
    CACHE_DRIVER=file
    REDIS_CLIENT=predis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    REDIS_DB=0
```

6. Run Migrations & seeder

```bash
    php artisan migrate --seed
```
7. Build Frontend Assets

```bash
    nmp run dev
```
Or, for production

```bash
    npm run build
```
8. Start the Development Server

```bash
    php artisan serve
```
### Usage

1. Register a User
- Visit http://localhost:8000/ to view the product listing.

2. Compare performance metrics between:
  - No Cache
  - File Cache
  - Redis Cache

3. Click "Clear Cache" to reset caches and observe performance differences

### Performance Expectations
- Initial load: Similar times for all methods (database query)
- Subsequent loads:
  - File cache: ~50-70% faster than no cache
  - Redis cache: ~80-90% faster than no cache
- Results vary based on server specifications and data size

### Project Structure
- Controllers:
    - app/Http/Controllers/HomeController.php: Handles product listing and cache management
- Models:
  - app/Models/Product.php: Product model
- Views:
    - resources/views/index.blade.php: Product listing view.
- Routes:
    - routes/web.php: Defines routes for registration
- Factory:
  - database/factories/ProductFactory.php: Seeds 10000 sample products
- Styles:
    - resources/css/app.css: Tailwind CSS styles.
