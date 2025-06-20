<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{



    
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in!');
        }

        $posts = Post::where('team_id', Auth::user()->team_id)->latest()->get();
        return view('team.posts.index', compact('posts'));
    }

    public function create()
    {
        $posts = Post::where('team_id', Auth::user()->team_id)->latest()->get();
        return view('team.posts.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post();
        $post->team_id = Auth::user()->team_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->status = $request->status;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post Published Successfully 🚀');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Check if the post belongs to the logged-in user's team
        if ($post->team_id !== Auth::user()->team_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized Access');
        }

        return view('team.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Allow updating image
        ]);
    
        $post = Post::findOrFail($id);
    
        if ($post->team_id !== Auth::user()->team_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized Access');
        }
    
        $post->title = $request->title;
        $post->content = $request->content;
    
        // **Handle Image Update**
        if ($request->hasFile('image')) {
            // **Delete the old image if it exists**
            if ($post->image) {
                \Storage::delete('public/' . $post->image);
            }
    
            // **Store the new image**
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image = $imagePath;
        }
    
        $post->save();
    
        return redirect()->route('posts.index')->with('success', 'Post Updated Successfully ✅');
    }
    

    public function destroy(Post $post)
    {
        if ($post->team_id !== Auth::user()->team_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized Access');
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post Deleted Successfully 🚫');
    }

    public function welcomePage()
    {
        $selectedTeam = session('selected_team');
    
        if ($selectedTeam) {
            $team = Team::find($selectedTeam);
            return view('welcome', compact('team'));
        }
    
        return view('welcome');
    }
    





    public function show($id)
    {
        // Assuming you're loading the team by its ID
        $team = Team::find($id);
    
        // Optionally store the selected team in the session or perform other logic
        session(['selected_team' => $team]);
    
        // Redirect to the welcome page
        return redirect()->route('welcome');
    }
    
    
    
    
    
    

    
}
