<?php

namespace Database\Seeders;

use App\Models\Casino;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CasinosTableSeeder extends Seeder
{
    public function run(): void
    {
        $path = __DIR__ . '/casinos.json';

        if (!File::exists($path)) {
            $this->command->error('casinos.json file not found!');
            return;
        }

        $casinosData = json_decode(File::get($path), true);

        foreach ($casinosData as $casinoData) {
            $casino = new Casino();

            $casino->name = $casinoData['name'];
            $casino->slug = $casinoData['slug'];
            $casino->link = $casinoData['link'];
            $casino->description = $casinoData['description'];
            $casino->highlights = $casinoData['highlights'];
            $casino->status = $casinoData['status'];
            $casino->published_at = $casinoData['published_at'];
            $casino->created_at = $casinoData['created_at'];
            $casino->updated_at = $casinoData['updated_at'];
            $casino->save();

            $imagePath = public_path("images/seed-logo-images/casino-{$casino->id}.png");

            if (File::exists($imagePath)) {
                $casino
                    ->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('logos');
            } else {
                $this->command->warn("Image not found for Casino ID {$casino->id}: casino-{$casino->id}.png");
            }
        }
    }
}
