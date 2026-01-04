<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategoriesTableSeeder extends Seeder
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
            PostCategory::create(['name' => $name]);
        }
    }
}
