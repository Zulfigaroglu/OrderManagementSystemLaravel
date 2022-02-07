## Setup

1. Run Docker

`` docker-compose up -d``

2. Install dependencies

``docker exec -it oms-app composer install``

3. Run database migrations

``docker exec -it oms-app php artisan migrate``

4. Run database seeders

``docker exec -it oms-app php artisan db:seed``
