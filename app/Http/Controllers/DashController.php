<?php

namespace App\Http\Controllers;

use App\Models\ZoomMeeting;

class DashController extends Controller
{
    public function index()
    {
        $today = \Carbon\Carbon::today()->format('Y-m-d');
        $currentUserId = auth()->id();
        $zoomMeetings = ZoomMeeting::whereDate('start_date_time', $today)
            ->where(function ($query) use ($currentUserId) {
                $query->where('user_id', $currentUserId)
                    ->orWhere('host_id', $currentUserId);
            })
            ->orderBy('start_date_time', 'asc')
            ->get();
        return view('dashboard', compact("zoomMeetings"));
    }
}
