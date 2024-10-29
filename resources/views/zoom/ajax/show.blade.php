@extends('components.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Show</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="/">
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
                    <a href="{{ $zoom->id }}">{{ $zoom->meeting_name }}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-title">{{ $zoom->meeting_name }}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ $zoom->start_link }}" style="margin-right: 5px"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-play"></i> Start Meeting
                                    </a>
                                    <a href="{{ route('zooms.index') }}" style="margin-right: 5px"
                                        class="btn btn-secondary btn-sm mr-3">
                                        Cancel
                                    </a>
                                    <a href="#"
                                        data-id="{{ $zoom->id }}"class="btn btn-black btn-sm delete-zoom-button"><i
                                            class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td style="width: 40%; vertical-align: middle">
                                        Meeting Host
                                    </td>
                                    <td>
                                        {{ $zoom->host->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%; vertical-align: middle">
                                        Password
                                    </td>
                                    <td>
                                        {{ $zoom->password }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%; vertical-align: middle">
                                        Starts On
                                    </td>
                                    <td>
                                        {{ $zoom->start_date_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%; vertical-align: middle">
                                        Ends On
                                    </td>
                                    <td>
                                        {{ $zoom->end_date_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%; vertical-align: middle">
                                        Description
                                    </td>
                                    <td>
                                        {{ $zoom->description }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.querySelectorAll('.delete-zoom-button');
            deleteButton.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const zoomId = this.getAttribute('data-id');
                    if (confirm("Are you sure you want to delete this meeting?")) {
                        fetch(`/account/zooms/${zoomId}`, {
                                method: "DELETE",
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content'),
                                    'Content-Type': 'application/json',
                                }

                            }).then(response => response.json()).then(data => {

                                if (data.success) {

                                    alert(" Meeting successfully deleted ");
                                    window.location.href = '/account/zooms';
                                } else {
                                    alert('An error occurred during the deletion process.');

                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                })
            })
        })
    </script>
@endsection
