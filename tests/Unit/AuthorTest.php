<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Author\Author as AuthorModel;
use Carbon\Carbon;


class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_authors()
    {
        AuthorModel::factory()->count(3)->create();

        $response = $this->getJson('/api/author');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_post_authors_creates_a_new_author()
    {
        $data = [
            'name' => 'John Doe',
            'birthday_date' => '1990-01-01',
        ];

        $response = $this->postJson('api/author', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment(['name' => 'John Doe']);
        $this->assertDatabaseHas('authors', $data);
    }

    public function test_get_author_by_id_returns_correct_author()
    {
        $author = AuthorModel::factory()->create();
        $response = $this->getJson("/api/author/{$author->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $author->id,
            'name' => $author->name,
        ]);
    }

    public function test_put_author_updates_author_data()
    {
        $author = AuthorModel::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'birthday_date' => '2000-01-01',
        ];

        $response = $this->putJson("/api/author/{$author->id}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('authors', $data);
    }

    public function test_delete_author_removes_author()
    {
        $author = AuthorModel::factory()->create();

        $response = $this->deleteJson("/api/author/{$author->id}");

        $response->assertStatus(204);
        $this->assertSoftDeleted('authors', ['id' => $author->id]);
    }
}
