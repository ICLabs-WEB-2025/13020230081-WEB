@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh">
    <div class="card shadow-lg" style="min-width: 400px">
        <div class="card-header bg-success text-white text-center">
            <h4>♻️ Login Admin</h4>
            <small>Waste Collection Information System</small>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" required autofocus>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-success w-100">Masuk</button>
            </form>
        </div>

        <div class="card-footer text-center">
            <small>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></small>
        </div>
    </div>
</div>
@endsection
