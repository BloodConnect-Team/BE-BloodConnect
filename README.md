# Backend-BloodConnect

> Backend-BloodConnect with JWT authentication that uses Mysql, and the Laravel framework 
## Requirements

- git
- laravel
- A browser (e.g., Firefox or Chrome)
- composser
- Mysql


## How To Start
- Install dependencies with 'composser install.
- rename the .env.example file to .env
- add mysql database information on .env
- add TOKEN_SECRET for JWT
- Run the server locally with `php artisan serve`
- run database migration with `php artisan migration`

## View local app in browser

- <http://localhost:8000>

## Test requests with Postman

- Install [Postman](https://www.getpostman.com/)
- Additional details in following sections

- POST <http://localhost:3000/api/user/register>
- POST <http://localhost:3000/api/user/login>
- GET <http://localhost:3000/api/example>


