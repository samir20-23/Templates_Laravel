<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Clear the table before seeding
        DB::table('products')->truncate();

        // Insert products
        DB::table('products')->insert([
            [
                'title' => 'Classic Watch',
                'description' => 'A timeless classic wristwatch for every occasion.',
                'price' => 199.99,
                'stock' => 50,
                'img_path' => 'images/products/watch_1.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Digital Watch',
                'description' => 'Modern digital watch with various features.',
                'price' => 99.99,
                'stock' => 100,
                'img_path' => 'images/products/watch_2.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_3.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_4.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_3.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_4.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_5.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_6.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_7.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_8.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_9.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Watch',
                'description' => 'A luxury watch for special occasions.',
                'price' => 999.99,
                'stock' => 10,
                'img_path' => 'images/products/watch_10.png', // Use forward slashes
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
     
        
    }
}
