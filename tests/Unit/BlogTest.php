<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_created_and_updated()
    {
        $blog = Blog::create([
            'title' => 'Test Blog',
            'content' => 'This is a test blog content.',
            'author' => 'Test Author',
            'published_at' => now(),
            'photo' => 'test.jpg'
        ]);

        $this->assertDatabaseHas('blogs', [
            'title' => 'Test Blog',
            'content' => 'This is a test blog content.',
            'author' => 'Test Author',
            'photo' => 'test.jpg'
        ]);

        // Update the blog
        $blog->update([
            'title' => 'Updated Blog Title'
        ]);

        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'title' => 'Updated Blog Title'
        ]);
    }

    /** @test */
    public function it_has_many_comments()
    {
        $blog = Blog::factory()->create();
        $comments = Comment::factory()->count(3)->create(['blog_id' => $blog->id]);

        $this->assertEquals(3, $blog->comments->count());
        foreach ($comments as $comment) {
            $this->assertTrue($blog->comments->contains($comment));
        }
    }

    /** @test */
    public function it_has_many_photos()
    {
        $blog = Blog::factory()->create();
        $photos = Photo::factory()->count(2)->create(['blog_id' => $blog->id]);

        $this->assertEquals(2, $blog->photos->count());
        foreach ($photos as $photo) {
            $this->assertTrue($blog->photos->contains($photo));
        }
    }
}
