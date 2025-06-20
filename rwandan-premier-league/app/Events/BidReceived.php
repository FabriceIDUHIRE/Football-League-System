<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BidReceived implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $bid;

    public function __construct($bid)
    {
        $this->bid = $bid;
    }

    public function broadcastOn()
    {
        return new Channel('bids');
    }
}
