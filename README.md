
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

### Feature Sprint 2 docs

-  fill the DATA_SOURCE with `REMOTE` or `DATABASE` to swap either using Remote data from RajaOngkir or local data from Database in `.env` file
``` bash
# Run API service
php artisan serve
```

### API docs for authentication:
- [POST] http://localhost:8000/api/auth/register
- [POST] http://localhost:8000/api/auth/login

### Request & Response example
```bash
### for Register
curl --location 'localhost:8000/api/auth/register' \
--form 'name="Satriyo"' \
--form 'email="satriyoaji27@gmail.com"' \
--form 'password="Password123"' \
--form 'confirm_password="Password123"'

### for Login
curl --location 'localhost:8000/api/auth/login' \
--form 'email="satriyoaji27@gmail.com"' \
--form 'password="Password123"'
```

```
### Unit Test Feature
- Unit Test using PHPUnit Test

``` bash
$ ./vendor/bin/phpunit
```

Goto Sprint 1:
[Sprint 1](https://github.com/satriyoaji/dot-test-api/tree/feat/sprint1)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
