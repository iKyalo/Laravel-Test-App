<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'blog_id' => 'required|exists:blogs,id'
        ]);        

        Comment::create([
            'comment' => $request->comment,
            'blog_id' => $request->blog_id,
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }
}
