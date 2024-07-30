<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogsControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_displays_a_list_of_blogs()
    {
        $blogs = Blog::factory()->count(3)->create();

        $response = $this->get('/blogs');

        $response->assertStatus(200);
        $response->assertViewHas('blogs', $blogs);
    }

    /** @test */
    public function it_displays_a_single_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->get("/blogs/{$blog->id}");

        $response->assertStatus(200);
        $response->assertViewHas('blog', $blog);
    }

    /** @test */
    public function it_loads_the_blog_creation_form()
    {
        $response = $this->get('/blogs/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_stores_a_new_blog()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->post('/blogs', [
            'title' => 'Sample Blog',
            'content' => 'This is a sample blog content.',
            'author' => 'Author Name',
            'published_at' => now(),
            'photo' => $file,
        ]);

        $response->assertRedirect('/blogs/' . Blog::first()->id);
        $response->assertSessionHas('success', 'Blog post created successfully.');

        Storage::disk('public')->assertExists('photos/' . Blog::first()->photo);
    }

    /** @test */
    public function it_loads_the_blog_edit_form()
    {
        $blog = Blog::factory()->create();

        $response = $this->get("/blogs/{$blog->id}/edit");

        $response->assertStatus(200);
        $response->assertViewHas('blog', $blog);
    }

    /** @test */
    public function it_updates_a_blog()
    {
        Storage::fake('public');

        $blog = Blog::factory()->create();

        $file = UploadedFile::fake()->image('newphoto.jpg');

        $response = $this->put("/blogs/{$blog->id}", [
            'title' => 'Updated Blog Title',
            'content' => 'Updated content.',
            'author' => 'Updated Author',
            'published_at' => now(),
            'photo' => $file,
        ]);

        $response->assertRedirect('/blogs');
        $response->assertSessionHas('success', 'Blog post updated successfully.');

        Storage::disk('public')->assertExists('photos/' . Blog::find($blog->id)->photo);
    }

    /** @test */
    public function it_deletes_a_blog()
    {
        $blog = Blog::factory()->create();

        $response = $this->delete('/blogs', ['blog_id' => $blog->id]);

        $response->assertRedirect('/blogs');
        $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);
    }
}
