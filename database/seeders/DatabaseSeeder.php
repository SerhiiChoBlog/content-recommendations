<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create();

        $posts = Post::factory(100)->create(['user_id' => $user]);

        $tags = collect([
            Tag::factory()->create(['name' => 'Laravel'])->id,
            Tag::factory()->create(['name' => 'PHP'])->id,
            Tag::factory()->create(['name' => 'JavaScript'])->id,
            Tag::factory()->create(['name' => 'Vue.js'])->id,
            Tag::factory()->create(['name' => 'React.js'])->id,
        ]);

        $posts->each(function (Post $post) use ($tags) {
            $post->tags()->attach($tags->random(2));
        });
    }
}
