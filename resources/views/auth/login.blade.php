@extends('layouts.auth')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class='container2'>
                                    <div>
                                        <img src='{{ asset('/img/carmen_logo.png') }}' class='iconDetails'>
                                    </div>
                                    <div style='margin-left:70px;margin-top:10px;'>
                                        <h4 style="text-transform: uppercase;text-align:center;">Residency of barangay
                                            inhabitants</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger border-left-danger" role="alert">
                                <ul class="pl-4 my-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger border-left-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="user">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <label for="">Email</label>
                            <div class="input-group mb-1">
                                <input id="email" type="email"
                                    class="form-control rounded-0 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    aria-label="Username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"
                                        style="background-color:transparent;"><i class="bi bi-person-check-fill"></i></span>
                                </div>
                            </div>

                            <label>Password</label>
                            <div class="input-group mb-3">
                                <input id="password" type="password" required
                                    class="form-control rounded-0 @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color: transparent"
                                        onclick="password_show_hide();">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded-0 btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>

                        <hr>

                        {{-- @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            </div>
                        @endif --}}

                        {{-- @if (Route::has('register'))
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">{{ __('Create an Account!') }}</a>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
