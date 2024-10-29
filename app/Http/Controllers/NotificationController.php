<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ZoomMeeting;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function all()
    {
        $userId = Auth::id();

        $notifications = Notification::where(function ($query) use ($userId) {
            $query->where('data->creator_id', $userId)
                ->orWhere('data->host_id', $userId);
        })
            ->with(['creator', 'host'])
            ->get();


        $formattedNotifications = $notifications->map(function ($notification) {
            $data = is_string($notification->data) ? json_decode($notification->data, true) : $notification->data;
            $zoomMeeting = isset($data['meeting_id']) ? ZoomMeeting::where('meeting_id', $data['meeting_id'])->first() : null;

            return [
                'type' => $notification->type,
                'message' => $data['message'] ?? 'No message',
                'meeting_name' => $data['meeting_name'] ?? 'No meeting name',
                'meeting_id' => $zoomMeeting->id ?? null,
                'created_at' => $notification->created_at->diffForHumans(),
            ];
        });


        return view('notifications.all_notification', compact('formattedNotifications'));
    }


    public function markRead($meeting_id)
    {

        $userId = Auth::id();

        $notification = Notification::where(function ($query) use ($userId, $meeting_id) {
            $query->whereJsonContains('data->creator_id', $userId)
                ->orWhereJsonContains('data->host_id', $userId)
                ->where('data->meeting_id', $meeting_id);
        })->first();


        if ($notification) {

            $notification->read_at = now();
            $notification->save();

            return response()->json([
                'message' => 'Notification marked as read.',
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => 'Notification not found.',
                'status' => 'error',
            ], 404);
        }
    }
}
