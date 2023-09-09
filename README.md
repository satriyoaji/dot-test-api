<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
# Laravel API Project test with MySQL and Unit Tests Integrated
This repo is an example implementation of an API project with implement repository-service pattern, clean code, OOP, and strict class. This repo also provide unit tests in every layer to keep code coverage.

## Installation

#### Dependencies

[Laravel](https://laravel.com)

[MySQL Database]([https://www.mongodb.com/docs/drivers/php/#installation](https://dev.mysql.com/downloads/connector/j/))

[Official PHP Page](http://php.net/manual/en/mongodb.installation.php)

#### Clone this repo


Enter this repo folder

``` bash
cd dot-test-api
```

Install Dependencies

``` bash
composer install
```

#### Configuration

Generate .env file

```bash
cp .env.example .env
```

Generate APP_KEY

``` bash
php artisan key:generate
```

#### Database Instance -> You have to run your MySQL Database and create one new Database instance to connect it.

#### Database Environment

``` bash
# Adjust your DB env dependencies (for example)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dot_test_api
DB_USERNAME=root
DB_PASSWORD=password

....

# adjut additional env vars for Sprint 1 & Sprint 2
RAJAONGKIR_API_KEY=0df6d5bf733214af6c6644eb8717c92c
DATA_SOURCE=DATABASE  # you can change to REMOTE
```

#### Run

``` bash
# cache clear environment file
php artisan config:cache
php artisan config:clear

# Migration 
php artisan migrate

# Run API service
php artisan serve
```

## Features

### Feature Sprint docs

[Sprint 1](https://github.com/satriyoaji/dot-test-api/tree/feat/sprint1)

[Sprint 2](https://github.com/satriyoaji/dot-test-api/tree/feat/sprint2)

```
### Others
- Unit Test using PHPUnit Test

``` bash
$ ./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

