<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusAbsensi
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nama_lengkap;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($nama_lengkap)
    {
        $this->nama_lengkap = $nama_lengkap;
        $this->message = "{$nama_lengkap} Berhasil Absensi";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('status-absensi'),
        ];
    }
}
