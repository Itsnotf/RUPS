# Laravel Fortify Stisla

Starter Kit Template Laravel + Stisla Dashboard

## Authors

-   [@amalkoding](https://www.github.com/amalkoding)

## Features

-   Multi Auth
-   Role Permission
-   Easy Crud
-   Easy Change Style (Color, Etc.)

## Installation

First, install composer. If you don't have, you can download it on google.

```bash
composer install
```

Second, copy .env from .env example

```bash
copy .env.example .env
```

Next, generate the application key:

```bash
php artisan key:generate
```

Then, configure your .env file to set up your database connection.

After that, create the symbolic link for storage:

```bash
php artisan storage:link
```

Run the migrations to create the database tables:

```bash
php artisan migrate
```

If prompted to create the database, type "yes".

Next, run the migrations with fresh seed data:

```bash
php artisan migrate:fresh --seed
```

Finally, serve the application:

```bash
php artisan serve
```

## Tech Stack

**Client:** Bootstrap, Fontawesome

**Server:** Laravel

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_KEY`

## Demo

Insert gif or link to demo

## Badges

License M. Amal Ikhsani

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/amalkoding/laravel_fortify_stisla)
