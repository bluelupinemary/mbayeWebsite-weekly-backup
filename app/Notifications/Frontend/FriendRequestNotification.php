<?php

namespace App\Notifications\Frontend;

use Illuminate\Bus\Queueable;
use App\Models\Access\User\User;
use App\Models\Friendships\Friendship;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class FriendRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $friendship;

    public function __construct(Friendship $friendship)
    {
        $this->friendship = $friendship;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }

    public function toDatabase($notifiable)
    {
        return [
                'sender_id' => $this->friendship->sender_id,
                'recipient_id'   => $this->friendship->recipient_id,
                'user' => User::where('id',$this->friendship->sender_id)->first(),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'status' => 'OK',
        ]);
    }
    public function broadcastType()
    {
        return 'new-friendrequest';
    }
}
