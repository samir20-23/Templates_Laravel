Here's a structured step-by-step guide to create a Laravel project with authentication and user roles, including an admin role to control access:

---

### Step 1: Create a Laravel Project
1. **Navigate to your project directory:**
   ```bash
   cd C:\C-PROJECT\🐱‍👤🪂LARAVEL\💲Ecommerc\
   ```
2. **Create a new Laravel project:**
   ```bash
   laravel new Template_Laravel_Auth
   ```

---

### Step 2: Install Laravel/UI for Authentication
1. **Navigate to your project folder:**
   ```bash
   cd Template_Laravel_Auth
   ```
2. **Install Laravel UI package:**
   ```bash
   composer require laravel/ui
   ```
3. **Generate authentication scaffolding:**
   ```bash
   php artisan ui bootstrap --auth
   ```
4. **Install dependencies and compile assets:**
   ```bash
   npm install
   npm run dev
   ```

---

### Step 3: Set Up the Database
1. **Edit the `.env` file** located in the project root:
   - Update database connection details:
     ```env
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     ```

2. **Run migrations to create the default user tables:**
   ```bash
   php artisan migrate
   ```

---

### Step 4: Add Admin Role
1. **Modify the `users` table migration** at `database/migrations/xxxx_xx_xx_create_users_table.php`:
   - Add a `role` column to differentiate admin and users:
     ```php
     $table->string('role')->default('user');
     ```

2. **Run the migration:**
   ```bash
   php artisan migrate
   ```

3. **Seed an admin user**:
   - Edit `database/seeders/DatabaseSeeder.php`:
     ```php
     use App\Models\User;

     public function run()
     {
         User::create([
             'name' => 'Admin',
             'email' => 'admin@example.com',
             'password' => bcrypt('password'),
             'role' => 'admin',
         ]);
     }
     ```
   - Run the seeder:
     ```bash
     php artisan db:seed
     ```

---

### Step 5: Protect Routes with Middleware
1. **Create a middleware for admin access:**
   ```bash
   php artisan make:middleware AdminMiddleware
   ```

2. **Edit the middleware file** at `app/Http/Middleware/AdminMiddleware.php`:
   ```php
   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Support\Facades\Auth;

   class AdminMiddleware
   {
       public function handle($request, Closure $next)
       {
           if (Auth::check() && Auth::user()->role === 'admin') {
               return $next($request);
           }
           return redirect('/'); // Redirect non-admin users
       }
   }
   ```

3. **Register the middleware** in `app/Http/Kernel.php`:
   ```php
   protected $routeMiddleware = [
       // ...
       'admin' => \App\Http\Middleware\AdminMiddleware::class,
   ];
   ```

---

### Step 6: Define Routes
1. **Edit `routes/web.php`:**
   ```php
   use App\Http\Controllers\AdminController;

   Route::get('/', function () {
       return view('welcome');
   });

   Route::middleware(['auth'])->group(function () {
       Route::get('/dashboard', function () {
           return view('dashboard');
       })->name('dashboard');

       Route::middleware(['admin'])->group(function () {
           Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
       });
   });
   ```

---

### Step 7: Create Admin Controller
1. **Generate a controller:**
   ```bash
   php artisan make:controller AdminController
   ```
2. **Edit `app/Http/Controllers/AdminController.php`:**
   ```php
   namespace App\Http\Controllers;

   class AdminController extends Controller
   {
       public function index()
       {
           return view('admin.index');
       }
   }
   ```

3. **Create the admin view** at `resources/views/admin/index.blade.php`:
   ```html
   <h1>Welcome, Admin!</h1>
   ```

---

### Step 8: Test the Application
1. **Run the Laravel development server:**
   ```bash
   php artisan serve
   ```
2. **Access the application:**
   - `/` - Public landing page.
   - `/dashboard` - User dashboard (requires login).
   - `/admin` - Admin dashboard (requires admin role).

---

This setup ensures:
- Regular users can only access user-specific pages.
- Admin users can access admin-only pages.