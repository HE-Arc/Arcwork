# Arcwork

Application web de référencement de projet.

# Installation

1. Clone project
```
git clone git@github.com:HE-Arc/Arcwork.git --recursive
```
## Laravel

2. Copy in arcwork-be/laradock/
```
cp .env.example .env
```
3. Modify these lines
```
COMPOSE_PROJECT_NAME=Arcwork
PHP_VERSION=7.4
...
MYSQL_DATABASE=arcworkdb
MYSQL_USER=homestead
MYSQL_PASSWORD=secret
...
NGINX_HOST_HTTP_PORT=8000
```
4. Copy in arcwork-be/
```
cp .env.example .env
```
5. Modify these lines
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=arcworkdb
DB_USERNAME=homestead
DB_PASSWORD=secret
```
6. Install dependencies
> execute inarcwork-be/laradock/
```
# Execute in laradock
docker-compose exec workspace bash
```
> install php and generate key
```
composer install
php artisan key:generate
```

## VueJS

6. Install dependencie
> Execute in arcwork-fe/
```
npm install
```

7. Run serve
> Execute in arcwork-fe/
```
npm run serve
```
