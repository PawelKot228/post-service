<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'text' => $this->faker->text(480),
            'status' => 1,
            'published_at' => Carbon::now(),
        ];
    }

    public function withCategory(User|int $user): static
    {
        if ($user instanceof User) {
            $user = $user->getKey();
        }

        return $this->state(fn(array $attributes) => [
            'user_id' => $user,
        ]);
    }
}
