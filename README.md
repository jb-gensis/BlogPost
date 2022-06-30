# BlogPost

# Setting up Dockerize
```
     Using :
    * Docker for mysql, nginx, php, redis
    * Laravel 8 and Vue
    * Laravel Sanctum for authentication
```

> Setting up laravel for empty project

## Build Setup

```bash
# clone repo
$ git clone https://github.com/jb-gensis/BlogPost.git

# Then goto BlogPost repo
$ cd BlogPost

# run docker for initializing and running project
$ docker-compose up --build

# Copy .env file
$ cp src/.env.example src/.env

# goto src directory 
$ cd src/

# src/ (inside the directory) composer & npm install for first use
$ composer install
$ npm install

# Migrate db and seed 
$ php artisan migrate:fresh --seed

# Then run artisan serve
$ php artisan serve

# Then run watch for npm
$ npm run watch

```

> For API Endpoints
> Goto API WIKIS folder/directory

