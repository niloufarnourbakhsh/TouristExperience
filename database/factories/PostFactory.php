<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $city=City::factory()->create();
        $user=User::factory()->create();
        return [
            'user_id'=>$user->id,
            'title'=>$this->faker->title,
            'slug'=>$this->faker->slug,
            'body'=>$this->faker->paragraph(4),
            'food'=>Str::random(10),
            'sightseeing'=>Str::random(10),
            'view'=>random_int(1,100),
            'city_id'=>$city->id,
        ];
    }
}
