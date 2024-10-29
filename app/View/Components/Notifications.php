<?php

namespace App\View\Components;

use App\Models\Notification;
use App\Models\ZoomMeeting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notifications extends Component
{
    public $notifications;

    public function __construct()
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $this->notifications = Notification::forUser($userId)
                ->orderBy('created_at', 'desc')
                ->get()
                ->filter(function ($notification) use ($userId) {
                    $data = is_string($notification->data) ? json_decode($notification->data, true) : $notification->data;
                    return isset($data['creator_id'], $data['host_id']) && ($data['creator_id'] == $userId || $data['host_id'] == $userId);
                });

            foreach ($this->notifications as $notification) {
                $data = is_string($notification->data) ? json_decode($notification->data, true) : $notification->data;
                $meeting = ZoomMeeting::where('meeting_id', $data['meeting_id'])->first();
                // dd($meeting);

                if ($meeting) {
                    $data['meeting_id'] = $meeting->id;
                    $notification->data = $data;
                }
            }
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.notifications', ['notifications' => $this->notifications]);
    }
}
