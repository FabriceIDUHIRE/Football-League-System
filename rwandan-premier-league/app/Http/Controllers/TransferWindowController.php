<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferWindow;
use App\Models\PlayerTransfer;  
use Illuminate\Support\Facades\Log;


class TransferWindowController extends Controller
{





    public function index()
    {
        // Get the current transfer window status
        $window = TransferWindow::latest()->first();
    
        // If no window exists, display a message
        if (!$window) {
            return view('transfersWindow.index', ['window' => null, 'transfers' => collect()]);
        }
    
        // Get all transfers (without checking the window status)
        $transfers = PlayerTransfer::with('player', 'fromTeam', 'toTeam')
            ->get(); // Remove the date range filter to get all transfers
    
        return view('transfersWindow.index', compact('transfers', 'window'));
    }
    
    



    public function open()
    {
        $window = TransferWindow::latest()->first();
    
        if (!$window) {
            $window = TransferWindow::create([
                'is_open' => true,
                'start_date' => now(),
                'end_date' => now()->addWeeks(4)
            ]);
        } else {
            $window->update([
                'is_open' => true,
                'start_date' => now(),
                'end_date' => now()->addWeeks(4)
            ]);
        }
    

    
        return redirect()->route('Windowtransfers.index')->with('success', 'Transfer window is now open!');
    }
    
public function close()
{
    // Get the current transfer window
    $window = TransferWindow::latest()->first();

    if ($window) {
        // Close the transfer window by updating the `is_open` flag
        $window->update([
            'is_open' => false
        ]);
    }

    return redirect()->route('Windowtransfers.index')->with('success', 'Transfer window is now Close!');
}

    
}

