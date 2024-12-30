<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => fake()->imageUrl(640 , 480 , 'posts'),
            'title' => fake()->name(),
            'content' => fake()->text(),
            'date' => today(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
