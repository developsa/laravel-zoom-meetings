@extends('components.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">New notifications</h3>
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
                    <a href="{{ route('notifications.all') }}">New notifications</a>
                </li>
            </ul>
        </div>
        @foreach ($formattedNotifications as $notification)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a
                            href="{{ $notification['meeting_id'] ? route('zooms.show', ['zoom' => $notification['meeting_id']]) : '#' }}">
                            <h4 class="card-title">{{ $notification['meeting_name'] }}</h4>
                        </a>

                    </div>
                    <div class="card-body">
                        <p>{{ $notification['message'] }}</p>
                        <p>{{ $notification['created_at'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
