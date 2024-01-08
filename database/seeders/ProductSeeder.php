<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eliminar imagenes de productos
        Storage::deleteDirectory('public/products');
        // Creamos el directorio
        Storage::makeDirectory('public/products');

        Product::factory(100)
            ->create()
            ->each(function (Product $product) {
                $faker = Faker::create();

                $product->image()->create([
                    'url' => 'products/' . $faker->image('public/storage/products', 640, 480, 'Product', false)]);
            });
    }
}
