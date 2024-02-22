# Notes on Recipe Search 3000
![Screenshot](/screenshot.png)

## Database Seeder
To test the app, run the database seeder.
```bash
./vendor/bin/sail artisan db:seed
```

I intentionally reused a handful of email addresses and ingredients to help make testing easier for both you and I (e.g. search for `salmon` in ingredients). The descriptions and steps are just lorem ipsum.

## Feature Tests
I wrote some tests to ensure that the recipe search functionality and recipe detail both work as expected.

Run `./vendor/bin/sail test` to run the tests.

## API Base URL
If you're laravel app isn't running on the default `http://localhost:8888`, you can update the value in `frontend/nuxt.config.ts`

## Nuxt SSR Disabled
Nuxt's SSR wasn't able to connect to the Laravel API for some reason, so I ended up disabling it for the sake of time.

======================================================

## Getting started

### Pre-requisites
- docker
- docker-compose

### Check out this repository
`git clone git@github.com:wildalaskan/skeleton-app.git`

`cd skeleton-app`

### Run composer to kickstart laravel sail

```bash
docker run --rm \
    --pull=always \
    -v "$(pwd)":/opt \
    -w /opt \
    laravelsail/php82-composer:latest \
    bash -c "composer install"
```

### Run the application
`cp .env.example .env`

`./vendor/bin/sail up -d`

`./vendor/bin/sail artisan key:generate`

`./vendor/bin/sail artisan migrate`

### Kickstart the nuxt frontend
`./vendor/bin/sail npm install --prefix frontend`

### Run the frontend
`./vendor/bin/sail npm run dev --prefix frontend`

### Confirm your application
visit the frontend http://localhost:3000

visit the backend http://localhost:8888


### Connecting to your database from localhost
`docker exec -it laravel-mysql-1 bash -c "mysql -uroot -ppassword"`

Or use any database GUI and connect to 127.0.0.1 port 3333


### Other tips
`./vendor/bin/sail down` to bring down the stack

Sometimes it's necessary to restart the nuxt app when adding new routes. Simply `ctrl+c` on the npm command execute
`./vendor/bin/sail npm run dev --prefix frontend` again
