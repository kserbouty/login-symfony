# Authentication with Symfony 5

## Features

- Registration.
- Login.
- Workspace creation as an authenticated user.

## Installation

### Requirements

- Apache Server >=2.4
- PHP >=7.2 with Composer

### Local Installation

1° Install the dependencies

```bash
composer install
```

2° Generate the .env file

```bash
composer dump-env dev
```

3° Set your database credentials in the .env file

4° Create the database

```bash
php bin/console doctrine:database:create
```

5° Migrate

```bash
php bin/console doctrine:migrations:migrate
```

7° Run your server

```bash
php -S localhost:8000 -t public
```

8° Run local tests

```bash
php bin/phpunit
```

## Authors

Karim Serbouty

## License

[GNU GPLv3](./LICENSE.txt)
