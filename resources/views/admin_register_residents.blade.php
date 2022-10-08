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
        <div class="card-header" style="font-weight: bold;">BARANGAY RESIDENT REGISTRATION</div>
        <form action="{{ route('admin_barangay_officials_registration_process') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text" class="form-control rounded-0" id="latitude">
                    </div>
                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text" class="form-control rounded-0" id="longitude">
                    </div>
                </div>

                <hr style="border: solid 2px;">


                <div class="row">
                    <div class="col-md-3">
                        <label style="font-weight: bold;">Personal Information</label>
                        <input type="text" name="first_name" placeholder="First Name"
                            class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <input type="text" placeholder="Middle Name" name="middle_name"
                            class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <input type="text" placeholder="Last Name" id="last_name" name="last_name"
                            class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <input type="text" placeholder="Nickname" id="nickname" name="nickname"
                            class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-4">
                        <label>Date of birth</label>
                        <input type="date" name="dob" class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-4">
                        <label>Place of birth</label>
                        <input type="text" id="place_of_birth" name="place_of_birth"
                            class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-4">
                        <label>Sex</label>
                        <select name="sex" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            <option value="Male" selected>Male</option>
                            <option value="Female" selected>Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Nationality</label>
                        <input type="text" name="nationality" class="form-control rounded-0" required>
                    </div>

                    <div class="col-md-4">
                        <label>Civil Status</label>
                        <select name="civil_status" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Separated">Separated</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>PWD</label>
                        <select name="pwd" id="pwd" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="col-md-12" style="display: none" id="show_trigger">
                        <label>PWD Description</label>
                        <textarea name="pwd_description" id="pwd_description" class="form-control rounded-0" required></textarea>
                    </div>

                </div>

                <div id="admin_registration_residents_generate_number_of_childrens_page"></div>
            </div>
            <div class="card-footer">
                <a class="btn btn-sm float-right btn-primary" id="family_registration_button"
                    style="margin-bottom: 10px;">Proceed</a>
            </div>
        </form>
    </div>

@endsection
