<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Loan\Loan as LoanModel;
use App\Models\Book\Book as BookModel;
use App\Models\Cliente;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendEmailJob;

class LoanTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_loan()
    {
        LoanModel::factory()->count(5)->create();

        $response = $this->getJson('/api/loan');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_show_returns_loan_details()
    {
        $loan = LoanModel::factory()->create();

        $response = $this->getJson("/api/loan/{$loan->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $loan->id]);
    }

    public function test_store_creates_new_loan_and_dispatches_email_job()
    {
        Queue::fake();

        $book = BookModel::factory()->create();
        $cliente = Cliente::factory()->create();
        $data = [
            'loan_date_final' => '2024-12-15',
            'book_id' => $book->id,
            'cliente_id' => $cliente->id,
        ];

        $response = $this->postJson('/api/loan', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('loans', [
            'book_id' => $book->id,
            'cliente_id' => $cliente->id,
        ]);

        Queue::assertPushed(SendEmailJob::class, function ($job) use ($cliente, $book) {
            return $job->loanInfo['email'] === $cliente->email &&
                   $job->loanInfo['name'] === $cliente->name;
        });
    }
}
