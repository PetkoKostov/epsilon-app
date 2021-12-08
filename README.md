## Installation

```bash
cp .env.example .env

sudo docker-compose up -d

sudo docker exec -it infinity-app /bin/bash

composer install

php artisan key:generate
```
Then go to:

http://localhost:8000/