<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
     public function run(): void
    {
        $tags = [
            'Technology',
            'Health',
            'Travel',
            'Science',
            'Politics',
            'Education',
            'Lifestyle',
            'Food',
            'Finance',
            'Entertainment',
            'Sports',
            'Art',
            'Culture',
            'Environment',
            'Fashion',
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate([
                'slug' => Str::slug($tag),
            ], [
                'name' => $tag,
            ]);
        }
    }
}
