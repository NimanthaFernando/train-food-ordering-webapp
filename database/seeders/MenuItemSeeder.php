<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insert([
            // Buns
            [
                'name' => 'Fish Bun',
                'description' => 'Delicious fish bun with spicy filling.',
                'price' => 80.00,
                'category' => 'Buns',
                'image' => 'fishbun.webp',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Egg Bun',
                'description' => 'Fresh bun with boiled egg inside.',
                'price' => 70.00,
                'category' => 'Buns',
                'image' => 'egg bun.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Drinks
            [
                'name' => 'Hot Tea',
                'description' => 'Sri Lankan style hot milk tea.',
                'price' => 50.00,
                'category' => 'Drinks',
                'image' => 'tea.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coffee',
                'description' => 'Hot brewed coffee.',
                'price' => 60.00,
                'category' => 'Drinks',
                'image' => 'coffee.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cool Drinks',
                'description' => 'Refreshing chilled beverage.',
                'price' => 100.00,
                'category' => 'Drinks',
                'image' => 'cool-drinks.jpeg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sweets
            [
                'name' => 'Chocolate Bar',
                'description' => 'Rich milk chocolate bar.',
                'price' => 120.00,
                'category' => 'Sweets',
                'image' => 'chocalate.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cupcake',
                'description' => 'Sweet vanilla cupcake.',
                'price' => 90.00,
                'category' => 'Sweets',
                'image' => 'cupcake.webp',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Snacks
            [
                'name' => 'Chinese Rolls',
                'description' => 'Cripsy vegetable rolls.',
                'price' => 60.00,
                'category' => 'Snacks',
                'image' => 'rools.webp',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Potato Chips',
                'description' => 'Salty crunchy chips.',
                'price' => 150.00,
                'category' => 'Snacks',
                'image' => 'potato chips.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Breakfast
            [
                'name' => 'String Hoppers',
                'description' => '10 String hoppers with sambol.',
                'price' => 200.00,
                'category' => 'Breakfast',
                'image' => 'string hoppers.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Noodles',
                'description' => 'Spicy vegetable noodles.',
                'price' => 250.00,
                'category' => 'Breakfast',
                'image' => 'noodles.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Lunch
            [
                'name' => 'Rice & Curry',
                'description' => 'Traditional rice and curry packet.',
                'price' => 350.00,
                'category' => 'Lunch',
                'image' => 'rice lunch.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fried Rice',
                'description' => 'Chicken fried rice with chili paste.',
                'price' => 450.00,
                'category' => 'Lunch',
                'image' => 'fried-rice.jpg',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Dinner
            [
                'name' => 'Rice Dinner',
                'description' => 'Standard dinner rice packet.',
                'price' => 300.00,
                'category' => 'Dinner',
                'image' => 'rice dinner.JPG',
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
