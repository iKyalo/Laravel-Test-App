<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class BlogsController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blog::all();
            return response()->json($blogs);
        } catch (\Exception $e) {
            Log::error('Error fetching blogs: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve blogs.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            return response()->json($blog);
        } catch (ModelNotFoundException $e) {
            Log::warning('Blog not found: ' . $id);
            return response()->json(['error' => 'Blog post not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error fetching blog: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve blog.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'author' => 'required|string|max:255',
                'published_at' => 'nullable|date',
            ]);

            $blog = Blog::create($request->all());

            return response()->json($blog, 201);
        } catch (ValidationException $e) {
            Log::warning('Validation failed for blog creation: ' . $e->getMessage());
            return response()->json(['error' => 'Validation failed.'], 422);
        } catch (\Exception $e) {
            Log::error('Error creating blog: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create blog.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'content' => 'sometimes|required|string',
                'author' => 'sometimes|required|string|max:255',
                'published_at' => 'nullable|date',
            ]);

            $blog->update($request->only(['title', 'content', 'author', 'published_at']));

            return response()->json($blog);
        } catch (ModelNotFoundException $e) {
            Log::warning('Blog not found for update: ' . $id);
            return response()->json(['error' => 'Blog post not found'], 404);
        } catch (ValidationException $e) {
            Log::warning('Validation failed for blog update: ' . $e->getMessage());
            return response()->json(['error' => 'Validation failed.'], 422);
        } catch (\Exception $e) {
            Log::error('Error updating blog: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update blog.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();
            return response()->json(['message' => 'Blog post deleted successfully']);
        } catch (ModelNotFoundException $e) {
            Log::warning('Blog not found for deletion: ' . $id);
            return response()->json(['error' => 'Blog post not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting blog: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete blog.'], 500);
        }
    }
}
