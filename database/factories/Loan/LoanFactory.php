<?php

namespace Database\Factories\Loan;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Loan\Loan;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author\AuthorModel>
 */
class LoanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'loan_date' => now(),
            'loan_date_final' => $this->faker->date(),
            'book_id' => \App\Models\Book\Book::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
        ];
    }
}
