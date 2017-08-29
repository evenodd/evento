# Evento

## Requirements 
Evento runs on laravel 5.4 which requires a server with the following installations:
- [Composer](https://getcomposer.org/)
- [PHP >= 5.6.4](http://php.net/)
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Set up
1. Rename the __src/main/php/.env.example__ file to __.env__, adding in the desired database and mail driver configurations

~~~~
# Example .env enviroment configurations
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=my_database
DB_USERNAME=my_user
DB_PASSWORD=my_password

MAIL_DRIVER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
~~~~

2. Navigate to the __src/main/php__ directory and run `composer install` to resolve dependencies.

3. To serve the web application you can simply run PHP's built-in server with the command `php artisan serve`.

4. Run `curl http://127.0.0.1:8000` to check the site is up. (Note: The app may be served on a different port)
