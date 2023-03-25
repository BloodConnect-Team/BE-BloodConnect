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
- GET <http://localhost:8000/api/getReq> (need authorization)
- GET <http://localhost:8000/api/getReq/filter/{goldar}> (need authorization)
- GET <http://localhost:8000/api/getReq/detail/{id}> (need authorization)
- GET <http://localhost:8000/api/getReq/my> (need authorization)
- POST <http://localhost:8000/api/postReq> (need authorization)

## Authorization
set Headers `Authorization : Baarer<YOUR_TOKEN>`
example `Authorization : BaarereyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI2Mjg4ODM4Y2U5YWZhMzViMmYxNTM3YjEiLCJpYXQiOjE2NTMxMTM3OTR9.7wdHLeDIxzJCm7ZyOWJSlk1b1HPp2Y4cxIVNzcnjf5g`

## Documentation

### Authentication
1. register

POST <http://localhost:8000/api/auth/register>
```
  "name": " "
  "email": " "
  "password": " "
  "goldar": " "
```

Example suceess Responds:
```JSON
{
    "response": 200,
    "success": true,
    "message": "Requests created successfully.",
    "data": true
}
```

2. Login

POST <http://localhost:3000/api/auth/login>
```
  "email": " "
  "password": ""
```

Example suceess Responds:
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

### Request

1. All Request

GET <http://localhost:3000/api/getReq>

Example suceess Responds:
```JSON
{
    {
    "response": 200,
    "success": true,
    "message": "Fetch all",
    "data": [
        {
            "id": 1,
            "Pasien": "fajar",
            "GolonganDarah": "A+",
            "JenisDonor": "WB",
            "Rs": "RS PMI",
            "Created": null
        },
        {
            "id": 2,
            "Pasien": "wawan",
            "GolonganDarah": "O+",
            "JenisDonor": "TC",
            "Rs": "RS PMI",
            "Created": null
        }
        ]
    }
}
```

2. Filter blood group

GET <http://localhost:3000/api/getReq/filter/{goldar}>
Example <http://localhost:3000/api/getReq/filter/A+>

Example suceess Responds:
```JSON
{
    {
    "response": 200,
    "success": true,
    "message": "Fetch all",
    "data": [
        {
            "id": 1,
            "Pasien": "fajar",
            "GolonganDarah": "A+",
            "JenisDonor": "WB",
            "Rs": "RS PMI",
            "Created": null
        }
        ]
    }
}
```

3. Detail Requests

GET <http://localhost:3000/api/getReq/detail/{id}>
Example <http://localhost:3000/api/getReq/detail/1>

Example suceess Responds:
```JSON
{
    "response": 200,
    "success": true,
    "message": "Fetch detail id: 1",
    "data": {
        "id": 1,
        "Pasien": "fajar",
        "GolonganDarah": "A+",
        "JenisDonor": "WB",
        "Kebutuhan": 2,
        "Catatan": "",
        "Rs": "RS PMI",
        "Lat": "-7.998964",
        "Lng": "112.645699",
        "User": "fajar",
        "UserGoldar": "",
        "Created": null
    }
}
```

4. My Requests

GET <http://localhost:3000/api/getReq/my>

Example suceess Responds:
```JSON
{
    "response": 200,
    "success": true,
    "message": "Fetch my all",
    "data": [
        {
            "id": 4,
            "Pasien": "tes",
            "GolonganDarah": "O+",
            "JenisDonor": "WB",
            "Kebutuhan": 4,
            "Catatan": null
            "Rs": "RS PMI",
            "Lat": "-7.998964",
            "Lng": "112.645699",
            "User": "fajar",
            "UserGoldar": "O+",
            "Created": null
        },
        {
            "id": 5,
            "Pasien": "tes",
            "GolonganDarah": "O+",
            "JenisDonor": "WB",
            "Kebutuhan": 4,
            "Catatan": null
            "Rs": "RS PMI",
            "Lat": "-7.998964",
            "Lng": "112.645699",
            "User": "fajar",
            "UserGoldar": "O+",
            "Created": null
        }
    ]
}
```

