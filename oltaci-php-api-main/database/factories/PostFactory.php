<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use App\Models\User;

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
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(4),
            'media' => $this->getRandomPostMedia(),
            'body' => $this->faker->text()
        ];
    }

    private function getRandomPostMedia()
    {
        $postMediaPath = storage_path('app/public/posts/');
        $files = File::files($postMediaPath);
        if (!empty($files)) {
            $randomFile = $files[array_rand($files)];
            return 'posts/' . $randomFile->getFilename();
        }
        return $this->faker->imageUrl(640, 480, 'business', true, 'Faker');
    }
}
