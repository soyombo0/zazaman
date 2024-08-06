# Установка

git clone https://github.com/soyombo0/zazaman.git

cd zazaman

cp .env.example .env

cd docker

docker compose up -d --build

docker composer exec app bash

## Внутри контейнера приложения

composer install

php artisan key:generate

php artisan migrate

php artisan db:seed --class=ParameterSeeder

# Endpoints

### GET - api/parameters 
Params - id, title
### POST - api/parameters/{parameter}/icon
Image - jpg file
### DELETE - api/parameters/{parameter}/icon
### POST - api/parameters/{parameter}/icon-gray
Image - jpg file
### DELETE - api/parameters/{parameter}/icon-gray
