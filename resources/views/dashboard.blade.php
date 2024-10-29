@extends('components.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Today</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}">Today's Zoom Meetings</a>
                </li>
            </ul>
        </div>
        <div class="row">
            @if ($zoomMeetings && count($zoomMeetings) > 0)
                @foreach ($zoomMeetings as $zoomMeeting)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $zoomMeeting->meeting_name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table table-striped table-head-bg table-hover">
                                        <thead>
                                            <tr>
                                                <th>Meeting Id</th>
                                                <th>Meeting Title</th>
                                                <th>Meeting Host</th>
                                                <th>Meeting Attendee</th>
                                                <th>Starts On</th>
                                                <th>Ends On</th>
                                                <th>Join Link</th>
                                                <th style="width: 10%;text-align: center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $zoomMeeting->meeting_id }}</td>
                                                <td>{{ $zoomMeeting->meeting_name }}</td>
                                                <td>{{ $zoomMeeting->creator->name }}</td>
                                                <td>{{ $zoomMeeting->host->name }}</td>
                                                <td class="date-time">
                                                    {{ \Carbon\Carbon::parse($zoomMeeting->start_date_time)->format('d-m-Y') }}&nbsp;{{ \Carbon\Carbon::parse($zoomMeeting->start_date_time)->format('H:i') }}
                                                </td>
                                                <td class="date-time">
                                                    {{ \Carbon\Carbon::parse($zoomMeeting->end_date_time)->format('d-m-Y') }}&nbsp;{{ \Carbon\Carbon::parse($zoomMeeting->end_date_time)->format('H:i') }}
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ $zoomMeeting->join_link }}">{{ $zoomMeeting->join_link }}</a>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ $zoomMeeting->start_link }}" style="margin-right: 5px"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fa fa-play"></i> Start Meeting
                                                        </a>
                                                        <a href="{{ route('zooms.show', $zoomMeeting->id) }}"
                                                            class="btn btn-info btn-sm" style="margin-right: 5px">
                                                            <i class="fa fa-eye"></i> Show
                                                        </a>
                                                        <a href="{{ route('zooms.edit', $zoomMeeting->id) }}"
                                                            class="btn btn-warning btn-sm" style="margin-right: 5px">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>

                                                        <a href="#" data-id="{{ $zoomMeeting->id }}"
                                                            class="btn btn-black btn-sm delete-zoom-button">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Record Not Found</h4>
                        </div>
                        <div class="card-body">
                            <p>No Zoom meeting found to display.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
