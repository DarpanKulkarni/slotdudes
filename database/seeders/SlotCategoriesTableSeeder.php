<?php

namespace Database\Seeders;

use App\Models\SlotCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Video Slots',
            'Classic Slots',
            'Progressive Jackpots',
            'Megaways',
            'Branded Slots',
            '3-Reel Slots',
            '5-Reel Slots',
        ];

        foreach ($categories as $name) {
            SlotCategory::create(['name' => $name]);
        }
    }
}
