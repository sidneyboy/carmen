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
                        <form method="POST" action="{{ route('register') }}" class="user">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <input type="text" class="form-control rounded-0" name="name"
                                    placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control rounded-0" name="middle_name"
                                    placeholder="{{ __('Middle Name') }}" value="{{ old('middle_name') }}" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control rounded-0" name="last_name"
                                    placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control rounded-0" name="email"
                                    placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control rounded-0" name="password"
                                    placeholder="{{ __('Password') }}" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control rounded-0" name="password_confirmation"
                                    placeholder="{{ __('Confirm Password') }}" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded-0 btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>

                        <hr>

                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">
                                {{ __('Already have an account? Login!') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
