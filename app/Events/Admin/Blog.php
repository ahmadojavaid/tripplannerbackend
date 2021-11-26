<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Blog implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $text;
  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($text)
  {
    $this->text = $text;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
    return new Channel('channel-name');
  }

  public function broadcastAs()
  {
    return 'blog';
  }
}
