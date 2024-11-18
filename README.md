prex challenge

./vendor/bin/sail up

./vendor/bin/sail artisan migrate\

sail artisan route:list

# Giphy API

## Descripción

Este proyecto es una API REST que se integra con la API de Giphy y proporciona servicios de autenticación y búsqueda de GIFs.

## Requisitos

- PHP 8.2
- Laravel 10
- MariaDB o MySQL
- Docker

## Instalación

1. Clonar el repositorio.
2. Ejecutar `composer install`.
3. Configurar el archivo `.env`.
4. Ejecutar `php artisan migrate`.
5. Ejecutar `php artisan passport:install`.
6. Levantar el proyecto con Docker: `docker-compose up -d`.

## Endpoints

- `POST /api/login`: Autenticación.
- `GET /api/gifs/search`: Buscar GIFs.
- `GET /api/gifs/{id}`: Buscar GIF por ID.
- `POST /api/favorites`: Guardar GIF favorito.

## Diagramas UML

- Diagrama de Casos de Uso.
- Diagrama de Secuencia.
- Diagrama de Datos o DER.

## Tests

Ejecutar `php artisan test` para correr los tests.

## Colección POSTMAN

Importar la colección POSTMAN desde el archivo `Giphy API.postman_collection.json`.