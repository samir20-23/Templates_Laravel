composer create-project --prefer-dist laravel/laravel LAST_version_auth
cd LAST_version_auth
composer global require laravel/installer
composer require laravel/breeze --dev
php artisan breeze:install
npm install
php artisan migrate:fresh
 php artisan db:seed
 php artisan make:migration add_role_to_users_table --table=users
php artisan make:middleware AdminMiddleware
