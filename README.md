# Registration and login with Symfony 5

---

## Requirements

- PHP 8+
- Composer 2+
- MySQL 8+

## Installation

Clone the repository

```bash
git clone https://github.com/kserbouty/login-symfony.git
```

Switch to the repository folder

```bash
cd login-symfony
```

Install all the dependencies using composer

```bash
composer install
```

Make the required configuration changes in the .env file

```bash
DATABASE_URL="mysql://dbuser:dbpassword@127.0.0.1:3306/dbname?serverVersion=8.0&charset=utf8"
```

Run the database migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

Start the local development server

```bash
php -S localhost:8000 -t public
```

You can now access the server at <http://localhost:8000>.

## Docker

To install with Docker, run following commands:

```bash
git clone https://github.com/kserbouty/login-symfony.git
cd login-symfony
docker compose up -d --build
docker exec web-server composer install
```

Make the required configuration changes in the .env file

```bash
DATABASE_URL="mysql://root:@database:3306/api_symfony?serverVersion=8.0&charset=utf8"
```

Run the database migrations

```bash
docker exec web-server php bin/console doctrine:database:create
docker exec web-server php bin/console doctrine:migrations:migrate -q
docker exec web-server php bin/console doctrine:fixtures:load -q
```

The website can be accessed at <http://localhost:8000>.

---

## Tests

Run local tests to verify login and registration

```bash
php bin/phpunit
```

---

## License

[GNU GPLv3](./LICENSE.txt)
