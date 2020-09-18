# Lumen API

## Start:

To create the data base

    php artisan migrate

Create users and populate the tables

    php artisan db:seed

Create users and populate the tables

    php -S localhost:8080 -t ./public/

## Users:

> -   Account: user@demo.com
> -   Pass: 123456789

> -   Account: moderator@demo.com
> -   Pass: 123456789

> -   Account: admin@demo.com
> -   Pass: 123456789

## API authorization:

### Register

Route

    localhost:8080/api/v1/register  (POST)

JSON

> {
>
> "name":"jose",
>
> "email":"juan@gmail.com",
>
> "password":"123456",
>
> "password_confirmation":"123456"
>
> }

### Login

Route

    localhost:8080/api/v1/login    (POST)

JSON

> {
>
> "email":"admin@demo.com",
>
> "password":"123456789"
>
> }

### Logout

Route

    localhost:8080/api/v1/logout    (POST)

JSON

> {
>
> "api_token":"fc4d....4da"
>
> }

## Available functions:

### Create

moderator, admin

    localhost:8080/api/v1/task     (POST)

JSON

> {
>
> "api_token":"3cf2f....121da7",
>
> "name":"cafe",
>
> "title":"Book cafe",
>
> "description":"cafe lorem..."
>
> }

### Read

user, moderator, admin

    localhost:8080/api/v1/task     (GET)

    localhost:8080/api/v1/task/{id}     (GET)

### Update

moderator, admin

    localhost:8080/api/v1/task/{id}   (PUT)

JSON

> {
>
> "api_token":"3cf2f....121da7",
>
> "name":"cafe",
>
> "title":"Book cafe",
>
> "description":"cafe lorem..."
>
> }

### Delete

admin

    localhost:8080/api/v1/task/{id}   (DELETE)

JSON

> {
>
> "api_token":"3cf2f....121da7",
>
> }
