<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'id' => 1,
                'title' => 'Home',
                'slug' => 'home',
                'content' => '',
                'status' => 'published',
                'is_home_page' => true,
                'show_in_menu' => true,
            ],
            [
                'id' => 2,
                'title' => 'Blog',
                'slug' => 'blog',
                'content' => '',
                'status' => 'published',
                'is_blog_page' => true,
                'show_in_menu' => true,
            ],
            [
                'id' => 3,
                'title' => 'Terms & Conditions',
                'slug' => 'affiliate',
                'content' => '<p>Terms and conditions page content goes here.</p>',
                'status' => 'published',
                'show_in_menu' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
