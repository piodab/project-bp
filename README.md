## About the project
Project of downloading data from an external repository and updating them once a day.

## Requirments
- PHP => 7.4
- Mysql
- Redis
- Composer

## Installation
- Copy example environment files
````shell script
cp .env.example .env
````
- Configure the connection to the database and redis in the .env file
- Install project dependencies
````shell script
composer install
````
- Run migrations
````shell script
php artisan migrate
````
- Import data from an external repository to a local database
````shell script
php artisan update:mitre-data
````
