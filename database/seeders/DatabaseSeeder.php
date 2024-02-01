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

        $posts = Post::factory(10_000)->create(['user_id' => $user]);

        $tags = collect([
            Tag::factory()->create(['name' => 'Laravel'])->id,
            Tag::factory()->create(['name' => 'PHP'])->id,
            Tag::factory()->create(['name' => 'JavaScript'])->id,
            Tag::factory()->create(['name' => 'Vue.js'])->id,
            Tag::factory()->create(['name' => 'React.js'])->id,
            Tag::factory()->create(['name' => 'Tailwind CSS'])->id,
            Tag::factory()->create(['name' => 'Alpine.js'])->id,
            Tag::factory()->create(['name' => 'Livewire'])->id,
            Tag::factory()->create(['name' => 'Inertia.js'])->id,
            Tag::factory()->create(['name' => 'Svelte'])->id,
            Tag::factory()->create(['name' => 'Ruby on Rails'])->id,
            Tag::factory()->create(['name' => 'Python'])->id,
            Tag::factory()->create(['name' => 'Django'])->id,
            Tag::factory()->create(['name' => 'Flask'])->id,
            Tag::factory()->create(['name' => 'SASS'])->id,
            Tag::factory()->create(['name' => 'CSS'])->id,
            Tag::factory()->create(['name' => 'HTML'])->id,
            Tag::factory()->create(['name' => 'Tailwind UI'])->id,
            Tag::factory()->create(['name' => 'Alpine UI'])->id,
            Tag::factory()->create(['name' => 'Laravel UI'])->id,
            Tag::factory()->create(['name' => 'Jetstream'])->id,
            Tag::factory()->create(['name' => 'Fortify'])->id,
            Tag::factory()->create(['name' => 'Sail'])->id,
            Tag::factory()->create(['name' => 'Nova'])->id,
            Tag::factory()->create(['name' => 'Forge'])->id,
            Tag::factory()->create(['name' => 'Vapor'])->id,
            Tag::factory()->create(['name' => 'Envoyer'])->id,
            Tag::factory()->create(['name' => 'Spark'])->id,
            Tag::factory()->create(['name' => 'Cashier'])->id,
            Tag::factory()->create(['name' => 'Dusk'])->id,
            Tag::factory()->create(['name' => 'Horizon'])->id,
            Tag::factory()->create(['name' => 'Sanctum'])->id,
            Tag::factory()->create(['name' => 'Scout'])->id,
            Tag::factory()->create(['name' => 'Socialite'])->id,
            Tag::factory()->create(['name' => 'Telescope'])->id,
            Tag::factory()->create(['name' => 'Tinker'])->id,
        ]);

        $posts->each(function (Post $post) use ($tags) {
            $post->tags()->attach($tags->random(random_int(1, 4)));
        });
    }
}
