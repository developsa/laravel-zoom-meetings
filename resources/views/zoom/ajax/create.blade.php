@extends('components.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3"> Zoom</h3>
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
                    <a href="{{ route('zooms.index') }}">Zoom</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('zooms.create') }}">Create</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Zoom Meeting Create</div>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('zooms.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-20">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group ">
                                            <label for="meeting_name">Meeting Title</label>
                                            <input type="text" class="form-control" id="meeting_name" name="meeting_name"
                                                placeholder="Enter Meeting Title" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group ">
                                            <label for="host_id">Employee</label>
                                            <select class="form-select" id="host_id" name="host_id">
                                                <option value="">Select</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="start_date">Starts On</label>
                                            <input type="text" class="form-control datepicker" id="start_date"
                                                name="start_date"
                                                placeholder="{{ \Carbon\Carbon::now()->format(config('app.date_format')) }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="start_time">Start Time</label>
                                            <input type="text" class="form-control" id="start_time" name="start_time"
                                                placeholder="" />

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="end_date">Ends On</label>
                                            <input type="text" class="form-control datepicker" id="end_date"
                                                name="end_date"
                                                placeholder="{{ \Carbon\Carbon::now()->format(config('app.date_format')) }}" />

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="end_time">End Time</label>
                                            <input type="text" class="form-control " id="end_time" name="end_time"
                                                placeholder="" />

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="comment">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="card-action " style="text-align: center">
                                        <button type="submit" class="btn btn-success ">Create</button>
                                        <a href="{{ route('zooms.index') }}" style="margin-right: 5px"
                                            class="btn btn-secondary  mr-3">
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#start_date, #end_date').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true
            });
        });

        $('#start_time, #end_time').timepicker({
            showMeridian: false,
            minuteStep: 1,
            icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down'
            }
        });
    </script>
@endsection