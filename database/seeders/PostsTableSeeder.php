<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostsTableSeeder extends Seeder
{
    public function run(): void
    {
        $path = __DIR__ . '/posts.json';

        if (!File::exists($path)) {
            $this->command->error('posts.json file not found!');
            return;
        }

        $userId = User::whereEmail('tonykion5@gmail.com')->first()->id;

        $postsData = json_decode(File::get($path), true);

        if (PostCategory::count() === 0) {
            $this->call(PostCategoriesTableSeeder::class);
        }

        $categories = PostCategory::all();

        foreach ($postsData as $postData) {
            $post = new Post();

            $post->user_id = $userId;
            $post->title = $postData['title'];
            $post->content = $postData['content'];
            $post->status = $postData['status'];
            $post->published_at = $postData['published_at'];
            $post->created_at = $postData['created_at'];
            $post->updated_at = $postData['updated_at'];
            $post->save();

            $post->categories()->attach($categories->random(1)->pluck('id')->toArray());

            $imagePath = public_path("images/seed-featured-images/post-{$post->id}.jpg");

            if (File::exists($imagePath)) {
                $post
                    ->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('featured-images');
            } else {
                $this->command->warn("Image not found for Post ID {$post->id}: post-{$post->id}.jpg");
            }
        }
    }
}
