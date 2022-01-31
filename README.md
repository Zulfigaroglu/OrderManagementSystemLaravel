## Setup

1. Run Docker

`` docker-compose up``

2. Install dependencies

``docker exec -it oms-app composer install``

3. Run database migrations

``docker exec -it oms-app php artisan migrate``
