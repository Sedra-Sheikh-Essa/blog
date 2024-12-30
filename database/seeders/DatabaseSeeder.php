<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Sedra Sheikh Essa',
            'email' => 'sedrash@gmail.com',
            'password' => Hash::make('password'),
            'permission' => 'admin',
            'image' => 'https://via.placeholder.com/640x480.png/009966?text=users+excepturi',
        ]);
        User::factory()->create([
            'name' => 'mostafa Sheikh Essa',
            'email' => 'mostafash@gmail.com',
            'password' => Hash::make('123'),
            'permission' => 'user',
            'image' => 'https://via.placeholder.com/640x480.png/009966?text=users+excepturi',
        ]);

        User::factory(5)->create();
        Category::factory(5)->create();
        Comment::factory(5)->create();
        $tags=Tag::factory(5)->create();
        Post::factory(5)->create()->each(function($post) use ($tags){
            $post->tags()->attach($tags->random(rand(1,3)));
        });


    }
}
