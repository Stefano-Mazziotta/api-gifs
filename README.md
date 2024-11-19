# Prex Challenge - Laravel API + Giphy API

## Description

This project is a REST API that integrates with the Giphy API and provides authentication and GIF search services.

## Requirements

- PHP 8.2
- Laravel 10
- MariaDB or MySQL
- Docker

## Installation

1. Clone the repository
2. Run `composer install`
3. Configure the `.env` file
4. Start the project with `./vendor/bin/sail up`
5. Run migrations with `./vendor/bin/sail artisan migrate`
6. Execute `./vendor/bin/sail artisan passport:client --personal`
7. Import the Postman collection, register a user, log in, and interact with the API.

## Endpoints
- `POST /api/register`: User registration.
- `POST /api/login`: Authentication.
- `GET /api/gifs/search`: Search for GIFs.
- `GET /api/gifs/{id}`: Search for GIF by ID.
- `POST /api/{id}/favorite`: Save favorite GIF.

## Tests

Run `./vendor/bin/sail artisan test` to execute the tests.

## POSTMAN Collection

Import the POSTMAN collection from the file `docs/prex-challenge.postman_collection.json`.

## ERD
![Entity-Relationship Diagram](docs/DER-1.png)
[Entity-Relationship Diagram PDF](docs/DER.pdf)

## Pending
- Use Case Diagram.
- Sequence Diagram.
- Implement custom Requests in endpoints to validate input.
- Implement automated tests for all operations.
- Implement CI/CD.
- Improve the management of generated access_tokens.
