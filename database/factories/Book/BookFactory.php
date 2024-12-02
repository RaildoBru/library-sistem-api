<?php

namespace Database\Factories\Book;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book\Book;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author\AuthorModel>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'publication_date' => $this->faker->date(),
        ];
    }
}
