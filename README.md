# laravel-geoip2
[![Build Status](https://travis-ci.org/chintanlin/laravel-geoip2.svg)](https://travis-ci.org/chintanlin/laravel-geoip2)
[![Latest Stable Version](https://poser.pugx.org/chintanlin/laravel-geoip2/v/stable.svg)](https://packagist.org/packages/chintanlin/laravel-geoip2)
[![Total Downloads](https://poser.pugx.org/chintanlin/laravel-geoip2/d/total.svg)](https://packagist.org/packages/chintanlin/laravel-geoip2)
[![License](https://poser.pugx.org/chintanlin/laravel-geoip2/license.svg)](https://packagist.org/packages/chintanlin/laravel-geoip2)

GeoIP2 for Laravel

- [laravel-geoip2 on Packagist](https://packagist.org/packages/chintanlin/laravel-geoip2)
- [laravel-geoip2 on GitHub](https://github.com/chintanlin/laravel-geoip2)

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