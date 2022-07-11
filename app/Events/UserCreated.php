<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * The User instance.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     *
     * @var unhashedPassword
     */
    public $unhashedPassword;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $unhashedPassword)
    {
        $this->user = $user;
        $this->unhashedPassword = $unhashedPassword;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
