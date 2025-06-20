<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // Display a listing of announcements
    public function index()
    {
        $announcements = Announcement::all(); // Fetch all announcements
        return view('announcements.index', compact('announcements'));
    }

    // Show the form for creating a new announcement
    public function create()
    {
        return view('announcements.create'); // Separate view for creation
    }

    // Store a newly created announcement
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string|min:10',
    ]);

    Announcement::create([
        'title' => $request->title,
        'content' => $request->content,
    ]);

    return redirect()->route('announcements.index')->with('success', 'Announcement created successfully!');
}


public function show($id)
{
    // Find the announcement by its ID
    $announcement = Announcement::findOrFail($id);

    // Pass the announcement to the view
    return view('announcements.show', compact('announcement'));
}

    


    // Show the form for editing an announcement
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    // Update the specified announcement
    public function update(Request $request, Announcement $announcement)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string', // Use 'content' instead of 'description'
    ]);

    $announcement->update($request->only(['title', 'content'])); // Use only the relevant fields

    return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully!');
}


    // Delete the specified announcement
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully!');
    }
}
