<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; 
class FeedbackController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        
        if (!$user || !$user->team) {
            return view('auth.login', ['message' => 'No team assigned to your account.']);
        }
    
        $team = $user->team;  
        $feedbacks = Feedback::where('team_id', $team->id)->latest()->get();
    
        return view('team.feedback', compact('team', 'feedbacks'));
    }
    


    public function show($id)
{

    $user = auth()->user();
        
        if (!$user || !$user->team) {
            return view('auth.login', ['message' => 'No team assigned to your account.']);
        }
    
        $team = $user->team;
    $feedback = Feedback::findOrFail($id);
    return view('team.feedbackDetails', compact('feedback','team'));
}

    
    
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'team_id' => 'required|exists:teamss,id', 
        ]);

        Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'team_id' => $request->team_id,
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }



};

