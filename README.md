# DBE Team - API

## Requirements

- PHP > 8.1

## Commands
```bash
composer install
```

```bash
php artisan migrate

#or with seeds
php artisan migrate:fresh --seeder=DevSeeder 

```


```bash
php artisan serve
```


## Observation
To access the API routes IT IS NOT NECESSARY to include the "/api" suffix in the routes.