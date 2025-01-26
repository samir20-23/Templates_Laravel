<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class CheckAndFixImages extends Command
{
    // Command name
    protected $signature = 'images:check';

    // Command description
    protected $description = 'Check for missing product images and assign default images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::all();

        foreach ($products as $product) {
            $imagePath = public_path($product->img_path);

            if (!file_exists($imagePath)) {
                // Set default image if not found
                $product->img_path = 'images/products/default.png';
                $product->save();
                $this->info("Fixed missing image for product: {$product->title}");
            }
        }

        $this->info('All missing images have been checked and fixed.');
    }
}
