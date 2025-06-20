<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use Illuminate\Http\Request;

class FinancialController extends Controller
{


    
    // Display a listing of financial records
    public function index()
{
    // Fetch all financial records
    $financials = Financial::all();

    // Return the financials view with the data
    return view('financials.index', compact('financials'));
}

    // Show the form to create a new financial record
    public function create()
    {
        return view('financials.create');
    }

    // Store a newly created financial record
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense', // Ensure only valid types
            'recorded_at' => 'required|date',
        ]);

        Financial::create($request->all());

        // Redirect with a success message
        return redirect()->route('financials.index')->with('success', 'Financial record created successfully!');
    }

    // Show the form for editing an existing financial record
    public function edit(Financial $financial)
    {
        return view('financials.edit', compact('financial'));
    }

    // Update the financial record
    public function update(Request $request, Financial $financial)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'recorded_at' => 'required|date',
        ]);

        $financial->update($request->all());

        // Redirect with a success message
        return redirect()->route('financials.index')->with('success', 'Financial record updated successfully!');
    }

    // Delete the financial record
    public function destroy(Financial $financial)
    {
        $financial->delete();

        // Redirect with a success message
        return redirect()->route('financials.index')->with('success', 'Financial record deleted successfully!');
    }
}
