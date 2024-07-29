<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Cache::remember('blogs.all', now()->addMinutes(10), function () {
            return Blog::all();
        });

        // $blogs = Blog::all();

        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with('photos')->findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'published_at' => 'nullable|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = null;
    
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('photos', $fileName, 'public');
            $photo->move(public_path('photos'), $fileName);
        }
    
        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'photo' => $fileName,
            'published_at' => $request->published_at,
        ]);
    
        return redirect('/blogs/' . $blog->id)->with('success', 'Blog post created successfully.');
    }
    
    
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blogPost)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'published_at' => 'nullable|date',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($request->blog_id);
        $fileName = $blog->photo;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('photos', $fileName, 'public');
            $photo->move(public_path('photos'), $fileName);
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'published_at' => $request->published_at,
            'photo' => $fileName,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Request $request)
    {
        $blog = Blog::findOrFail($request->blog_id);
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
