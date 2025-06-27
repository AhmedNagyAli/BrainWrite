<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Section;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArabicPostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // Use the first available user
        $category = Category::first(); // Use the first available category
        $tags = Tag::inRandomOrder()->take(3)->get();

        $posts = [
            [
                'title' => 'أهمية القراءة في تطوير الذات',
                'excerpt' => 'القراءة هي الوسيلة الأولى لاكتساب المعرفة وتوسيع الآفاق.',
                'content' => 'تُعدّ القراءة من أهم المهارات التي يجب أن يتحلّى بها الإنسان في هذا العصر...',
            ],
            [
                'title' => 'التكنولوجيا وتأثيرها على حياتنا اليومية',
                'excerpt' => 'التكنولوجيا أصبحت جزءاً لا يتجزأ من حياتنا اليومية.',
                'content' => 'في العصر الحديث، نعتمد على التكنولوجيا في جميع مجالات الحياة من التعليم إلى الترفيه...',
            ],
            [
                'title' => 'كيفية الحفاظ على الصحة النفسية',
                'excerpt' => 'الصحة النفسية لا تقل أهمية عن الصحة الجسدية.',
                'content' => 'يجب على الفرد الاهتمام بنفسه من خلال النوم الكافي، التغذية السليمة، وممارسة التأمل...',
            ],
        ];

        foreach ($posts as $index => $data) {
            $post = Post::create([
                'user_id' => $user?->id,
                'category_id' => $category?->id,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']) . '-' . $index,
                'excerpt' => $data['excerpt'],
                'meta_title' => $data['title'],
                'meta_description' => $data['excerpt'],
                'image' => null,
                'video' => null,
                'video_url' => null,
                'status' => 'published',
                'published_at' => now(),
                'visited' => rand(50, 300),
            ]);

            Section::create([
                'post_id' => $post->id,
                'title' => 'مقدمة',
                'content' => $data['content'],
                'order' => 1,
            ]);

            // Attach tags
            $post->tags()->sync($tags->pluck('id'));
        }
    }
}
