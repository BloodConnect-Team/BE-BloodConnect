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


## Routes
- POST <http://localhost:8000/api/auth/register>
- POST <http://localhost:8000/api/auth/login>

## Documentation

### Register


POST <http://localhost:8000/api/auth/register>

```
  "name": " "
  "email": " "
  "password": " "
  "goldar": " "
```

Should return something like:

```JSON
{
    "response": 200,
    "success": true,
    "message": "Requests created successfully.",
    "data": true
}
```

### Login

POST <http://localhost:3000/api/auth/login>

```
  "email": " "
  "password": ""
```

Should return something like:

```JSON
{
    "response": 200,
    "success": true,
    "message": "Login Successfully",
    "access_token": "JWT-Token",
    "token_type": "bearer",
    "expires_in": 3600
}
```

3. GET <http://localhost:3000/api/example>
set Headers `auth-token : <YOUR_TOKEN>`
example `auth-token : eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2Mjg4ODM4Y2U5YWZhMzViMmYxNTM3YjEiLCJpYXQiOjE2NTMxMTM3OTR9.7wdHLeDIxzJCm7ZyOWJSlk1b1HPp2Y4cxIVNzcnjf5g`


response:

```JSON
{
    "title": "Example Title",
    "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel libero turpis. Suspendisse venenatis, nunc nec aliquam mollis, mi libero aliquam nunc, ut condimentum odio metus id nisi. Sed ac ex placerat, egestas dui vel, fermentum leo. Fusce sed velit at enim tempus vehicula. Nulla maximus sit amet turpis id aliquam. Donec ut arcu hendrerit, convallis augue et, laoreet tortor. Proin interdum magna consectetur lacinia posuere. Sed erat nunc, laoreet sed justo id, dapibus imperdiet elit. Vestibulum sit amet ornare ipsum. Sed cursus metus non nisl euismod, eget mollis metus blandit. Nulla facilisi. "
}
```

