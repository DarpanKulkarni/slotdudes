<?php

namespace Database\Seeders;

use App\Models\ReviewCategory;
use App\Models\SlotReview;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SlotReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        $path = __DIR__ . '/slotreviews.json';

        if (!File::exists($path)) {
            $this->command->error('slotreviews.json file not found!');
            return;
        }

        $userId = User::whereEmail('tonykion5@gmail.com')->first()->id;

        $slotReviewsData = json_decode(File::get($path), true);

        $categories = ReviewCategory::all();

        foreach ($slotReviewsData as $slotReviewData) {
            $slotReview = new SlotReview();

            $slotReview->user_id = $userId;
            $slotReview->title = $slotReviewData['title'];
            $slotReview->content = $slotReviewData['content'];
            $slotReview->status = $slotReviewData['status'];
            $slotReview->published_at = $slotReviewData['published_at'];
            $slotReview->created_at = $slotReviewData['created_at'];
            $slotReview->updated_at = $slotReviewData['updated_at'];
            $slotReview->save();

            $slotReview->categories()->attach($categories->random(1)->pluck('id')->toArray());

            $imagePath = public_path("images/seed-featured-images/post-{$slotReview->id}.jpg");

            if (File::exists($imagePath)) {
                $slotReview
                    ->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('featured-images');
            } else {
                $this->command->warn("Image not found for Slot Review ID {$slotReview->id}: post-{$slotReview->id}.jpg");
            }
        }
    }
}
