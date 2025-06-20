<?php

namespace App\Http\Controllers;

use App\Models\MatchCategory;
use Illuminate\Http\Request;

class MatchCategoryController extends Controller
{



    
    // Display a list of all match categories
    public function index()
    {
        $categories = MatchCategory::all(); // Fetch all categories
        return view('match_categories.index', compact('categories')); // Pass data to the index view
    }

    // Show the form to create a new match category
    public function create()
    {
        return view('match_categories.create'); // Render the create form
    }

    // Store a newly created match category in the database
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Create and save the new category
        MatchCategory::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect to index with success message
        return redirect()->route('match_categories.index')->with('success', 'Category created successfully!');
    }

    // Display the details of a specific category
    public function show($id)
    {
        $category = MatchCategory::findOrFail($id); // Find category or fail
        return view('match_categories.show', compact('category')); // Pass category to view
    }

    // Show the form to edit an existing category
    public function edit($id)
    {
        $category = MatchCategory::findOrFail($id); // Find category or fail
        return view('match_categories.edit', compact('category')); // Pass category to edit view
    }

    // Update the specified category in the database
    public function update(Request $request, $id)
    {
        // Validate the updated data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Find category and update it
        $category = MatchCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect to index with success message
        return redirect()->route('match_categories.index')->with('success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy($id)
    {
        $category = MatchCategory::findOrFail($id); // Find category or fail
        $category->delete(); // Delete the category

        // Redirect back with success message
        return redirect()->route('match_categories.index')->with('success', 'Category deleted successfully!');
    }
}
