
### tutos
```pash
 composer create-project --prefer-dist laravel/laravel LAST_version_auth
```

```pash
 cd LAST_version_auth
```

```pash
 composer global require laravel/installer
```

```pash
 composer require laravel/breeze --dev
```

```pash
 php artisan breeze:install
```

```pash
 npm install
```

```pash
 php artisan migrate:fresh
```

```pash
  php artisan db:seed
```

```pash
  php artisan make:migration add_role_to_users_table --table=users
```

```pash
 php artisan make:middleware AdminMiddleware
```

### authentication  jetstream
```pash
composer require laravel/jetstream
php artisan jetstream:install livewire
npm install && npm run dev
php artisan migrate
php artisan serve

```

### templates for  authentication, user roles (admin/user),
```pash 
git clone https://github.com/rappasoft/laravel-boilerplate.git
cd laravel-boilerplate
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev

```
### permission
```pash
composer require spatie/laravel-permission
```