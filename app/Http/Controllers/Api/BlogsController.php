<?php

namespace Tests\Feature\Api;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_all_blogs()
    {
        $blogs = Blog::factory()->count(3)->create();

        $response = $this->getJson('/api/blogs');

        $response->assertStatus(200);
        $response->assertJson($blogs->toArray());
    }

    /** @test */
    public function it_can_fetch_a_single_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->getJson("/api/blogs/{$blog->id}");

        $response->assertStatus(200);
        $response->assertJson($blog->toArray());
    }

    /** @test */
    public function it_returns_404_if_blog_not_found()
    {
        $response = $this->getJson('/api/blogs/9999');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Blog post not found'
        ]);
    }

    /** @test */
    public function it_can_create_a_blog()
    {
        $response = $this->postJson('/api/blogs', [
            'title' => 'New Blog Title',
            'content' => 'Content of the new blog.',
            'author' => 'Author Name',
            'published_at' => now()->toDateString(),
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'title' => 'New Blog Title',
            'content' => 'Content of the new blog.',
            'author' => 'Author Name',
        ]);

        // Verify the blog is created in the database
        $this->assertDatabaseHas('blogs', [
            'title' => 'New Blog Title',
            'content' => 'Content of the new blog.',
            'author' => 'Author Name',
        ]);
    }

    /** @test */
    public function it_can_update_a_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->putJson("/api/blogs/{$blog->id}", [
            'title' => 'Updated Blog Title',
            'content' => 'Updated content of the blog.',
            'author' => 'Updated Author Name',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'title' => 'Updated Blog Title',
            'content' => 'Updated content of the blog.',
            'author' => 'Updated Author Name',
        ]);

        // Verify the blog is updated in the database
        $blog->refresh();
        $this->assertEquals('Updated Blog Title', $blog->title);
        $this->assertEquals('Updated content of the blog.', $blog->content);
        $this->assertEquals('Updated Author Name', $blog->author);
    }

    /** @test */
    public function it_returns_404_if_blog_not_found_on_update()
    {
        $response = $this->putJson('/api/blogs/9999', [
            'title' => 'Nonexistent Blog Title',
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Blog post not found'
        ]);
    }

    /** @test */
    public function it_can_delete_a_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->deleteJson("/api/blogs/{$blog->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Blog post deleted successfully'
        ]);

        // Verify the blog is deleted from the database
        $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);
    }

    /** @test */
    public function it_returns_404_if_blog_not_found_on_delete()
    {
        $response = $this->deleteJson('/api/blogs/9999');

        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'Blog post not found'
        ]);
    }
}
