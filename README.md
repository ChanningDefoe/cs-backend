# cs-backend

## Install Dependencies

To run this repo you must have [composer](https://getcomposer.org/) installed.

```
composer install
```

## Env Setup

To use the correct enviroment variables run the following:

```bash
# Copy the .env file
cp .env.example .env
```

The default port for docker is 80, you may need to change the app port on your machine and place it in your .env. I have placed port 8000 in the .env.example. Example:

```
APP_PORT=8000
```

## Docker Run

This project uses [Laravel Sail](https://laravel.com/docs/8.x/sail). You can use the following commands after running composer install to bring up the project:
```bash
# start the project
./vendor/bin/sail up
```

## Setup

This project relies on the data available at: https://s3.amazonaws.com/commentsold-share/data.zip

After downloading the data, place the contents of the `/data` folder in your local project under `/app/storage` in a folder called `import`. You should have the following files on your machine:

- `/storage/app/import/inventory.csv`
- `/storage/app/import/orders.csv`
- `/storage/app/import/products.csv`
- `/storage/app/import/users.csv`


Then run the following commands in order:

```bash
# Generate app key
./vendor/bin/sail artisan key:generate

# run database migrations
./vendor/bin/sail artisan migrate

# run commands to create data
./vendor/bin/sail artisan create:data

# generate the jwt key
./vendor/bin/sail artisan jwt:secret
```
