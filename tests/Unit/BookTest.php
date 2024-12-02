<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Author\Author as AuthorModel;
use App\Models\Book\Book as BookModel;
use Carbon\Carbon;


class BookTest extends TestCase {
    use RefreshDatabase;

    public function test_index_returns_all_books()
    {
        BookModel::factory()->count(5)->create();

        $response = $this->getJson('/api/book');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_show_returns_book_details()
    {
        $book = BookModel::factory()->create();

        $response = $this->getJson("/api/book/{$book->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['title' => $book->title]);
    }

    public function test_store_creates_a_new_book_with_authors()
    {
        $authors = AuthorModel::factory()->count(2)->create();
        $data = [
            'title' => 'New Book',
            'publication_date' => '2022-01-01',
            'authors' => $authors->pluck('name')->toArray(),
        ];

        $response = $this->postJson('/api/book', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment(['title' => 'New Book']);
        $this->assertDatabaseHas('books', ['title' => 'New Book']);
        $this->assertCount(2, BookModel::first()->authors);
    }

    public function test_update_modifies_book_details()
    {
        $book = BookModel::factory()->create();
        $data = [
            'title' => 'Updated Title',
            'publication_date' => '2023-01-01',
        ];

        $response = $this->putJson("/api/book/{$book->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('books', ['id' => $book->id, 'title' => 'Updated Title']);
    }

    public function test_destroy_soft_deletes_book()
    {
        $book = BookModel::factory()->create();

        $response = $this->deleteJson("/api/book/{$book->id}");

        $response->assertStatus(204);
        $this->assertSoftDeleted('books', ['id' => $book->id]);
    }

}
