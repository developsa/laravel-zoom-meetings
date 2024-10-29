@extends('components.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Zoom</h3>
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
                    <a href="{{ route('zooms.index') }}">Table</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('zooms.create') }}" class="btn btn-primary btn-round">
                                <i class="fa fa-plus"></i> Create Meeting
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-zoom" class="display table table-striped table-head-bg table-hover ">
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
                                    @foreach ($zooms as $zoom)
                                        <tr>
                                            <td>{{ $zoom->meeting_id }}</td>
                                            <td>{{ $zoom->meeting_name }}</td>
                                            <td>{{ $zoom->creator->name }}</td>
                                            <td>{{ $zoom->host->name }}</td>
                                            <td class="date-time">
                                                {{ \Carbon\Carbon::parse($zoom->start_date_time)->format('d-m-Y') }}&nbsp;{{ \Carbon\Carbon::parse($zoom->start_date_time)->format('H:i') }}
                                            </td>
                                            <td class="date-time">
                                                {{ \Carbon\Carbon::parse($zoom->end_date_time)->format('d-m-Y') }}&nbsp;{{ \Carbon\Carbon::parse($zoom->end_date_time)->format('H:i') }}
                                            </td>
                                            <td>
                                                <a href="{{ $zoom->join_link }}">{{ $zoom->join_link }}</a>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ $zoom->start_link }}" style="margin-right: 5px"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fa fa-play"></i> Start Meeting
                                                    </a>
                                                    <a href="{{ route('zooms.show', $zoom->id) }}"
                                                        class="btn btn-info btn-sm" style="margin-right: 5px">
                                                        <i class="fa fa-eye"></i> Show
                                                    </a>
                                                    <a href="{{ route('zooms.edit', $zoom->id) }}"
                                                        class="btn btn-warning btn-sm" style="margin-right: 5px">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>

                                                    <a href="#" data-id="{{ $zoom->id }}"
                                                        class="btn btn-black btn-sm delete-zoom-button">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#add-zoom").DataTable({
            pageLength: 5,
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.querySelectorAll('.delete-zoom-button');
            deleteButton.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const zoomId = this.getAttribute('data-id');
                    console.log(zoomId);
                    if (confirm("Are you sure you want to delete this meeting?")) {
                        fetch(`/account/zooms/${zoomId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Meeting successfully deleted .');
                                    window.location.href = '/account/zooms';
                                } else {
                                    alert('An error occurred during the deletion process');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
@endsection
