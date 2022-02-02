## About Laravel

git clone https://github.com/nwebdev/product-crud.git

cd product-crud

composer install

cp .env.example .env

php artisan migrate

sudo chmod -R 777 storage/*
sudo chmod -R 777 public/image
sudo chmod -R 777 bootstrap/cache

php artisan key:generate

php artisan optimize:clear

## Thankyou
