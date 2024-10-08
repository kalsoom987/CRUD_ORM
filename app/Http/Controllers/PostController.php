<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create'); // Create a view for the post creation form
    }

    // Store a newly created post in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Create a new post
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Display a listing of the posts
    public function index()
    {
        $posts = Post::paginate(10); // Get all posts with pagination
        return view('posts.index', compact('posts')); // Pass posts to the index view
    }

    // Show the specified post
    public function show(Post $post)
    {
        return view('posts.show', compact('post')); // Pass the post to the show view
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post')); // Pass the post to the edit view
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Update the post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Remove the specified post from storage
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
