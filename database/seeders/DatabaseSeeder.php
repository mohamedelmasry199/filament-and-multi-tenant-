<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        Product::create([
            'name' => 'Product 1',
            'price' => 10.99,
            'description' => 'Product 1 description',
        ]);
        Product::create([
            'name' => 'Product 2',
            'price' => 19.99,
            'description' => 'Product 2 description',
        ]);
        Product::create([
            'name' => 'Product 3',
            'price' => 29.99,
            'description' => 'Product 3 description',
        ]);
        Category::create([
            'name' => 'Category 1',
        ]);
        Category::create([
            'name' => 'Category 2',
        ]);
        Category::create([
            'name' => 'Category 3',
        ]);
        Order::create([
            'user_id' => 1,
            'product_id' => 1,
            'price' => 10.99
        ]);
        order::create([
            'user_id' => 1,
            'product_id' => 2,
            'price' => 19.99
        ]);
        order::create([
            'user_id' => 1,
            'product_id' => 2,
            'price' => 19.99
        ]);
        order::create([
            'user_id' => 1,
            'product_id' => 2,
            'price' => 19.99
        ]);

order::create([
            'user_id' => 1,
            'product_id' => 1,
            'price' => 19.99
        ]);

    }
}
