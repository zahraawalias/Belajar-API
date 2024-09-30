@extends('layouts.auth')

@section('title')
    Login Account
@endsection

@section('content')
    <div class="auth-form">
        <div class="card my-5">
            <div class="card-body">
                <div class="text-center mb-3">
                    <a href="/">
                        <img src="{{ asset('assets/images/logo-dark.svg') }}" alt="img">
                    </a>
                </div>
                <h4 class="text-center fw-bold mb-1">Login Account</h4>
                <h6 class="text-center text-muted mb-4">Portal {{ env('TITLE_APP') }}</h6>

                <form action="{{ route('loginHris') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Email OneKalbe <small class="text-danger">*</small></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="example@kalbe.co.id">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password <small class="text-danger">*</small></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="*****">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex mt-1 justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input input-primary" type="checkbox" id="customCheckc1">
                            <label class="form-check-label text-muted" for="customCheckc1">Ingatkan Saya Untuk Selalu Login
                                Pada Aplikasi</label>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Login Account</button>
                    </div>
                </form>
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <h6 class="f-w-500 mb-0">Lupa Password ?</h6>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="link-primary">Cek
                        Panduan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
