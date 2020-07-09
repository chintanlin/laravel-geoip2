# laravel-geoip2
GeoIP2 for Laravel

# First
composer.json add the content

```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/chintanlin/laravel-geoip2"
        }
    ]
```    
# Install

```bash
composer require chintanlin/laravel-geoip2

```

# How to use

```php
    GeoIP2::getCountry('8.8.8.8');  // Facades
    app('geoip2')->getCountry('8.8.8.8'); // Providers
    geoip2('8.8.8.8'); // helpers
    
    // use maxmind/GeoIP2 PHP API directly
    $record = GeoIP2::city('8.8.8.8'); 
    $record->country->name;

```

# Update Database

Database file store at storage_path('app/GeoLite2-City.mmdb')

ex : Laravel/storage/app/GeoLite2-City.mmdb

You should use your private license key in .env (MAXMIND_LICENSE=xxxx)

``` bash
    php artisan geoip2:update;
```