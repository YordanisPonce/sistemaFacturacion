# Laravel MiniProject with Swagger Documentation and PostgreSQL

## Prerequisites

Make sure you have the following prerequisites installed in your development environment:

- PHP (recommended version: 8.2 or higher)
- Composer (https://getcomposer.org/)
- PostgreSQL (https://www.postgresql.org/)

## Steps to Clone and Set Up the Project

1. Clone the project repository from GitHub:

2. Navigate to the project directory
## cd project
3. Install the Composer dependencies
## composer install
4. Create a copy of the `.env.example` file and rename it to `.env`:
## cp .env.example .env
5. Open the `.env` file in a text editor and configure the following environment variables:
## DB_CONNECTION=pgsql
## DB_HOST=127.0.0.1
## DB_PORT=5432
## DB_DATABASE=your_database_name
## DB_USERNAME=your_postgresql_username
## DB_PASSWORD=your_postgresql_password

6. Create a new database in PostgreSQL with the name specified in `DB_DATABASE` in the `.env` file.

7. Generate an application key:
## php artisan key:generate

8. Create storage link:
## php artisan storage:link

9. Run the migrations to create the tables in the database:
## php artisan migrate

10. Start the Laravel development server:
## php artisan serve
