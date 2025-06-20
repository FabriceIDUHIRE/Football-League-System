<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; // Add this line
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function welcomePage()
    {
        $teamHistory = DB::table('teamss')->select('history')->get(); // Now this will work!
        return view('welcome', compact('teamHistory'));
    }
}


