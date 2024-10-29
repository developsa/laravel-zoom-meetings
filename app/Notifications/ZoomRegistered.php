<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ZoomRegistered extends Notification
{
    use Queueable;
    protected $zoomMeeting;
    public function __construct($zoomMeeting)
    {
        $this->zoomMeeting = $zoomMeeting;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'meeting_name' => $this->zoomMeeting->meeting_name,
            'meeting_id' => $this->zoomMeeting->meeting_id,
            'message' => 'New Created Zoom Meeting: ' . $this->zoomMeeting->meeting_name,
            'time' => now(),
            'creator_id' => Auth::id(),
            'host_id' => $this->zoomMeeting->host_id,

        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
