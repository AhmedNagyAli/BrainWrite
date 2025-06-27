<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'News',
            'Technology',
            'Science',
            'Health',
            'Travel',
            'Food',
            'Lifestyle',
            'Entertainment',
            'Business',
            'Finance',
            'Politics',
            'Education',
            'Culture',
            'Art',
            'Fashion',
            'Sports',
            'Environment',
            'Opinion',
            'Gaming',
            'Books',
            'Parenting',
            'History',
            'DIY',
            'Productivity',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
            ]);
        }
    }
}
