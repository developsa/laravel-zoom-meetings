@extends('components.app')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3"> Profile</h3>
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
                    <a href="{{ route('zooms.index') }}">Profile</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    Edit
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"> Edit Profile</div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('profile.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row p-20">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                value="{{ $user->name }}" name="name" placeholder="Enter Name " />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email"
                                                value="{{ $user->email }}" name="email" placeholder="Enter Email " />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Mevcut Şifre</label>
                                            <div class="input-group">
                                                <input type="password" name="avaliable_password" id="current_password"
                                                    class="form-control" placeholder="Mevcut Şifre">
                                                <div class="input-group-append">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary border-grey toggle-password"
                                                        data-target="#current_password">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Yeni şifre</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="new_password"
                                                    class="form-control" placeholder="Yeni şifre">
                                                <div class="input-group-append">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary border-grey toggle-password"
                                                        data-target="#new_password">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-action " style="text-align: center">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <a href="{{ route('dashboard') }}" style="margin-right: 5px"
                                            class="btn btn-secondary  mr-3">
                                            Cancel
                                        </a>
                                    </div>

                                    <div style="text-align: center">
                                        <a href="{{ route('forgot.password') }}">
                                            <small>Forgot Password?</small>
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
    <script>
        $('document').ready(function() {
            $('.toggle-password').on('click', function() {
                var target = $(this).data('target');
                var passwordInput = $(target);
                if (passwordInput.length) {
                    var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                    passwordInput.attr('type', type);
                    $(this).find('i').toggleClass('fa-eye fa-eye-slash')
                }
            })
        })
    </script>
@endsection
