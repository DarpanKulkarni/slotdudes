<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Casino Reviews',
            'Online Casinos',
            'Slot Games',
            'Table Games',
            'Live Casino',
            'Bonuses & Promotions',
            'Payment Methods',
            'Casino Guides',
            'Responsible Gambling',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
