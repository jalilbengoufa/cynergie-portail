# cynergie-portail

## Using Laravel 5.6 , Vuejs and  docker to deploy 

### This project reassemble

- Cynergie website
- Cynergie portail
- Cynergie data api

#### Help

- to run bash inside a docker container

```
docker exec -it cynergieportail bash
```

- to run a command in the container ; laravel exemple:

```
docker-compose exec cynergieportail php artisan list
```

- to run a migration for database ; laravel exemple:

```
docker-compose run laravel php artisan migrate
```