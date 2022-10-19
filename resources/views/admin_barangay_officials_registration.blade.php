@extends('layouts.admin')

@section('main-content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header" style="font-weight: bold;">BARANGAY OFFICIALS REGISTRATION</div>
        <form action="{{ route('admin_barangay_officials_registration_process') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>First Name</label>
                        <input type="text" class="form-control rounded-0" value="{{ old('name') }}" name="name"
                            required>
                    </div>
                    <div class="col-md-4">
                        <label>Middle Name</label>
                        <input type="text" class="form-control rounded-0" value="{{ old('middle_name') }}"
                            name="middle_name" required>
                    </div>
                    <div class="col-md-4">
                        <label>Last Name</label>
                        <input type="text" class="form-control rounded-0" value="{{ old('last_name') }}" name="last_name"
                            required>
                    </div>
                    <div class="col-md-4">
                        <label>Gender</label>
                        <select class="form-control rounded-0" value="{{ old('gender') }}" name="gender" required>
                            <option value="" default>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Rather Not Say">Rather Not Say</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>DOB</label>
                        <input type="date" class="form-control rounded-0" value="{{ old('date_of_birth') }}"
                            name="dob" required>
                    </div>

                    <div class="col-md-4">
                        <label>User Type</label>
                        <select class="form-control rounded-0" name="user_type" required>
                            <option value="" default>Select</option>
                            <option value="Admin">Admin</option>
                            <option value="Monitoring">Monitoring</option>
                            <option value="Lupon">Lupon</option>
                            <option value="Live Monitoring">Live Monitoring</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" class="form-control rounded-0" value="{{ old('email') }}" name="email"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label>Password</label>
                        <input type="password" class="form-control rounded-0" name="password" required>
                    </div>

                    <div class="col-md-4">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control rounded-0" name="password_confirmation" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm float-right btn-primary">Save</button>
            </div>
        </form>
    </div>
    <br />
    <div class="card">
        <div class="card-header" style="font-weight:bold;">User List</div>
        <div class="card-body">
            <table class="table table-striped table-hover" id="example">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>DOB / Age</th>
                        <th>User Type</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user_list as $data)
                        <tr>
                            <td>{{ $data->name }} {{ $data->middle_name }} {{ $data->last_name }}</td>
                            <td>{{ $data->gender }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                @php
                                    
                                    $dateOfBirth = $data->dob;
                                    $today = date('Y-m-d');
                                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                    echo $data->dob . ' / ' . $diff->format('%y');
                                @endphp
                            </td>
                            <td>{{ $data->user_type }}</td>
                            <th>
                                @if ($data->user_status == null)
                                    <a href="{{ url('disable_user', ['id' => $data->id]) }}">Disable</a>
                                @else
                                    <a href="{{ url('enable_user', ['id' => $data->id]) }}">Enable</a>
                                @endif
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
