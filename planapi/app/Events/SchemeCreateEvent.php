<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SchemeCreateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msgchannel;

    // public $scheme_name;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msgchannel, $message)
    {
        // $this->scheme_id = $scheme_id;

        // $this->scheme_name = $scheme_name;
        $this->msgchannel = $msgchannel;
        $this->message  = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [$this->msgchannel];
    }
}