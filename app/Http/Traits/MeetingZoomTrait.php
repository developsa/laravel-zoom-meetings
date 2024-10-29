<?php

namespace App\Http\Traits;

use App\Models\ZoomMeeting;
use Carbon\Carbon;
use MacsiDigital\Zoom\Facades\Zoom;

trait MeetingZoomTrait
{
    public function createMeeting($request)
    {
        $user = Zoom::user()->first();
        $startDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->start_date . ' ' . $request->start_time);
        $endDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->end_date . ' ' . $request->end_time);
        $meetingData = [
            'topic' => $request->meeting_name,
            'start_time' => $startDateTime,
            'duration' => $endDateTime->diffInMinutes($startDateTime),
            'timezone' => 'Europe/Istanbul',
            'agenda' => $request->description,
        ];

        $meeting = Zoom::meeting()->make($meetingData);
        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'approval_type' => 1,
            'mute_upon_entry' => true,
            'registration_type' => 2,
            'enforce_login' => false,
            'waiting_room' => false,
        ]);
        return $user->meetings()->save($meeting);
    }

    public function updateMeeting($request, $id)
    {
        $zoomMeeting = ZoomMeeting::findOrFail($id);
        $meeting_id = $zoomMeeting->meeting_id;

        $user = Zoom::user()->first();
        $meeting = $user->meetings()->find($meeting_id);

        $startDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->start_date . ' ' . $request->start_time);
        $endDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->end_date . ' ' . $request->end_time);
        $meetingData = [
            'topic' => $request->meeting_name,
            'start_time' => $startDateTime,
            'duration' => $endDateTime->diffInMinutes($startDateTime),
            'timezone' => 'Europe/Istanbul',
            'agenda' => $request->description,

        ];
        try {
            $meeting->update($meetingData);
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
        return $meeting;
    }


    public function deleteMeeting($id)
    {
        $zoomMeeting = ZoomMeeting::findOrFail($id);

        $meeting_id = $zoomMeeting->meeting_id;

        $user = Zoom::user()->first();
        $meeting = $user->meetings()->find($meeting_id);
        try {
            $meeting->delete();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return $meeting;
    }
}
