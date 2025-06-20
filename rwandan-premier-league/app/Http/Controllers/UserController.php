<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team; // Include the Team model to get the teams list
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $teams = Team::all(); // Fetch all teams
        return view('users.index', compact('users', 'teams')); // Pass teams along with users
    }
    

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => 'blocked',
            'blocked_at' => Carbon::now(),
        ]);
        return redirect()->route('users.index')->with('success', 'User blocked for 24 hours.');
    }

    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => 'active',
            'blocked_at' => null,
        ]);
        return redirect()->route('users.index')->with('success', 'User unblocked successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pass the list of teams to the view
        $teams = Team::all(); 
        return view('users.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
            'team_id' => 'nullable|exists:teamss,id', // Ensure team exists if provided
        ]);
        
        // Log the request data to check if everything is passed correctly
        \Log::info('User creation data:', $validatedData);
        
        // Create the user
        User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
            'team_id' => $validatedData['team_id'],
            'status' => 'active',
        ]);
        
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed', // Validation rules
        ]);
    
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password); // Encrypt password
        $user->save();
    
        return redirect()->route('users.show', $id)->with('success', 'Password updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
