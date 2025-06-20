<?php

namespace App\Http\Controllers;

use App\Models\MatchCommissioner;
use Illuminate\Http\Request;

class MatchCommissionerController extends Controller
{



    
    public function index()
    {
        $matchCommissioners = MatchCommissioner::all(); // Fetch all match commissioners
        return view('match_commissioners.index', compact('matchCommissioners'));
    }

    public function create()
    {
        return view('match_commissioners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:match_commissioners,email',
            'phone' => 'required|string|max:15',
        ]);

        MatchCommissioner::create($request->all()); // Store the new match commissioner
        return redirect()->route('match_commissioners.index')->with('success', 'Match Commissioner added successfully.');
    }

    public function edit(MatchCommissioner $matchCommissioner)
    {
        return view('match_commissioners.edit', compact('matchCommissioner'));
    }

    public function update(Request $request, MatchCommissioner $matchCommissioner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:match_commissioners,email,' . $matchCommissioner->id,
            'phone' => 'required|string|max:15',
        ]);

        $matchCommissioner->update($request->all()); // Update the match commissioner
        return redirect()->route('match_commissioners.index')->with('success', 'Match Commissioner updated successfully.');
    }

    public function destroy(MatchCommissioner $matchCommissioner)
    {
        $matchCommissioner->delete(); // Delete the match commissioner
        return redirect()->route('match_commissioners.index')->with('success', 'Match Commissioner deleted successfully.');
    }
}

