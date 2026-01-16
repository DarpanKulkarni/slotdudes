<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        File::cleanDirectory(storage_path('app/public'));

        User::factory()->create([
            'name' => 'Tony Kion',
            'email' => 'tonykion5@gmail.com',
            'password' => Hash::make('TonyKion@123'),
        ]);

        /*$this->call([
            PostCategoriesTableSeeder::class,
            PostsTableSeeder::class,
            ReviewCategoriesTableSeeder::class,
            SlotReviewsTableSeeder::class,
            PagesTableSeeder::class,
            CasinosTableSeeder::class,
        ]);*/
    }
}
