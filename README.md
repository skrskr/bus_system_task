# Bus Booking System

## Installation
```
1- Clone Repo
    - git clone https://github.com/skrskr/bus_system_task.git
2- Create .env file
    - cp .env.example .env
3- Change database config variables in .env
    - DB_HOST=db
    - DB_USERNAME=db_user
    change also DB_DATABASE & DB_PASSWORD
4- Run with docker
    - docker compose up
```

## Migrate & seed data to database
```
1- migrate & seed data to database
    - docker compose run --rm app php artisan migrate --seed
2- Use testing user
    - Email:    admin@mail.com
    - Password: password
```

## Testing APIS
```
1- Import postman collection in docs folder, i saved examples for testing
    - use email & password to login in login endpoint and get auth token
    - list available seats api (using auth token)
    - book availabe seat api (using auth token)
```