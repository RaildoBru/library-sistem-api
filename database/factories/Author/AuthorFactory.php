<?php

namespace Database\Factories\Author;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author\Author;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author\AuthorModel>
 */
class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'birthday_date' => $this->faker->date(),
        ];
    }
}
