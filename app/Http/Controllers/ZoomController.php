<?php

namespace App\Http\Controllers;

use App\Http\Traits\MeetingZoomTrait;
use App\Models\User;
use App\Models\ZoomMeeting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\ZoomRegistered;
use Illuminate\Support\Facades\Auth;

class ZoomController extends Controller
{
    use MeetingZoomTrait;

    public function index()
    {
        $user_id = Auth::id();
        $zooms = ZoomMeeting::where('user_id', $user_id)->orWhere('host_id', $user_id)->with(['creator', 'host'])->get();
        return view('zoom.index', compact("zooms"));
    }
    public function create()
    {
        $users = User::all();
        return view('zoom.ajax.create', compact("users"));
    }

    public function store(Request $request)
    {
        $meeting = $this->createMeeting($request);
        $startDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->start_date . ' ' . $request->start_time);
        $endDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->end_date . ' ' . $request->end_time);
        $zoomMeeting = ZoomMeeting::create([
            'user_id' => Auth::id(),
            'host_id' => $request->host_id,
            'meeting_id' => $meeting->id,
            'meeting_name' => $request->meeting_name,
            'description' => $request->description,
            'password' => $meeting->password,
            'start_date_time' => $startDateTime,
            'end_date_time' => $endDateTime,
            'start_link' => $meeting->start_url,
            'join_link' => $meeting->join_url
        ]);

        $user = User::find(Auth::id());
        $user->notify(new ZoomRegistered($zoomMeeting));
        return redirect()->route("zooms.index")->with("success", "Saved Database")->with('alert-type', 'success');
    }

    public function show(string $id)
    {
        $zoom = ZoomMeeting::with("creator")->findOrFail($id);
        return view("zoom.ajax.show", compact("zoom"));
    }

    public function edit(string $id)
    {
        $zoom = ZoomMeeting::with("creator")->findOrFail($id);
        $users = User::all();
        return view("zoom.ajax.edit", compact("zoom", "users"));
    }

    public function update(Request $request, string $id)
    {
        $meeting = $this->updateMeeting($request, $id);
        $startDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->start_date . ' ' . $request->start_time);
        $endDateTime = Carbon::createFromFormat("d-m-Y H:i", $request->end_date . ' ' . $request->end_time);

        $zoomMeeting = ZoomMeeting::findOrFail($id);
        $zoomMeeting->update([
            'user_id' =>  Auth::id(),
            'host_id' => $request->host_id,
            'meeting_id' => $meeting->id,
            'meeting_name' => $request->meeting_name,
            'description' => $request->description,
            'password' => $meeting->password,
            'start_date_time' => $startDateTime,
            'end_date_time' => $endDateTime,
            'start_link' => $meeting->start_url,
            'join_link' => $meeting->join_url
        ]);

        return redirect()->route("zooms.index")->with("success", "Updated Database")->with('alert-type', 'success');
    }

    public function destroy(string $id)
    {
        $meeting = $this->deleteMeeting($id);

        $zoom = ZoomMeeting::findOrFail($id);
        try {
            $zoom->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
