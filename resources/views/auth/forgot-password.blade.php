@include('auth.components.header')

<div class="app-brand justify-content-center">
    <span class="app-brand-text demo text-body fw-bolder">Forgot Password</span>
</div>

<h4 class="mb-2">Forgot Password? 🔒</h4>
<p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
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
<form class="mb-3" action="{{ route('forgot.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email"
            autofocus />
    </div>
    <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
</form>
<div class="text-center">
    <a href="{{ route('login.index') }}" class="d-flex align-items-center justify-content-center">
        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
        Back to Login
    </a>
</div>
@include('auth.components.footer')
