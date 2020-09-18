# Lumen API

## Start:

To create the data base

    php artisan migrate

Create users and populate the tables

    php artisan db:seed

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

    /api/v1/register  (POST)

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

    /api/v1/login    (POST)

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

    /api/v1/logout    (POST)

JSON

> {
>
> "api_token":"fc4d....4da"
>
> }

## Available functions:

### Create

### Read

### Update

### Delete
