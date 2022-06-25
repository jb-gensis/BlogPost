# BlogPost

# Setting up Dockerize Laravel

> Setting up laravel for empty project

## Build Setup

```bash
# clone repo
$ git clone https://github.com/jb-gensis/BlogPost.git

# Then goto BlogPost repo
$ cd BlogPost

# run docker for initializing and running project
$ docker-compose up --build

# goto src directory 
$ cd src/

# src/ (inside the directory) composer & npm install for first use
$ cp src/.env.example src/.env
$ composer install
$ npm install && npm run dev

# Migrate db and seed 
$ php artisan migrate --seed

# Then run artisan serve
$ php artisan serve

# Then run watch for npm
$ npm run watch

```

> For API Endpoints
> Goto API WIKIS folder/directory

