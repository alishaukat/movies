Update the .env file by providing the following:
DB_CONNECTION
DB_HOST
DB_DATABASE
DB_USERNAME
DB_PASSWORD

Please run the following commands

composer update
composer dump-autoload
php artisan key:generate
php artisan migrate
php artisan db:seed