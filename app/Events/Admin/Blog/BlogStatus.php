<?php

namespace App\Events\Admin\Blog;

use App\Models\UserArticle;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BlogStatus implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $article;
  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(UserArticle $article)
  {
    $this->article = $article;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
    return new PrivateChannel('blog-user');
  }


  public function broadcastAs()
  {
    return 'status';
  }
}
