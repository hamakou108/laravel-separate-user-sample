# Laravel Separate User Sample

## Installation

Clone this repository.

```
git clone git@github.com:hamakou108/laravel-separate-user-sample.git
```

## Usage

Create .env from .env.example.

```
cp .env.example .env
```

Run Docker containers and initialize app.

```
docker-compose up -d
docker exec -it laravel-separate-user-sample_app_1 composer install
docker exec -it laravel-separate-user-sample_app_1 php artisan key:generate
docker exec -it laravel-separate-user-sample_app_1 php artisan migrate
```

Start the development server.

```
docker exec -it laravel-separate-user-sample_app_1 php artisan serve --host 0.0.0.0
```

You can access the application in your web browser at http://localhost:8000.

### MailHog

http://localhost:8025

## License

[MIT license](https://opensource.org/licenses/MIT)

