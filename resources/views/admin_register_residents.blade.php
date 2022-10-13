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
                <li>Please pin in the map the exact location of resident</li>
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header" style="font-weight: bold;">BARANGAY RESIDENT REGISTRATION</div>
        <form action="{{ route('admin_register_residents_process') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="map"></div>
                        <input type="hidden" value="{{ asset('/carmen_images/pin.png') }}" id="marker_image">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text" class="form-control rounded-0" name="latitude" id="latitude">
                    </div>
                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text" class="form-control rounded-0" name="longitude" id="longitude">
                    </div>
                </div>
                <br />
                {{-- <h2><span style="color:black;">House Hold Information</span></h2>
                <div class="row">
                    <div class="col-md-4">
                        <label>Family Name</label>
                        <input type="text" class="form-control rounded-0" name="family_name" required>
                    </div>
                    <div class="col-md-4">
                        <label>Zone</label>
                        <select name="zone" class="form-control rounded-0">
                            <option value="" default>Select</option>
                            <option value="Zone 1">Zone 1</option>
                            <option value="Zone 2">Zone 2</option>
                            <option value="Zone 3">Zone 3</option>
                            <option value="Zone 4">Zone 4</option>
                            <option value="Zone 5">Zone 5</option>
                            <option value="Zone 6">Zone 6</option>
                            <option value="Zone 7">Zone 7</option>
                            <option value="Zone 8">Zone 8</option>
                            <option value="Zone 9">Zone 9</option>
                            <option value="Zone 10">Zone 10</option>
                            <option value="Zone 11">Zone 11</option>
                            <option value="Zone 12">Zone 12</option>
                            <option value="Zone 13">Zone 13</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Number of Family Members</label>
                        <input type="number" class="form-control rounded-0" required id="number_of_childrens"
                            name="number_of_childrens">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Ethic Origin</label>
                        <select name="ethnic_origin" id="ethnic_origin" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            <option value="Cebuano">Cebuano</option>
                            <option value="Ilocano">Ilocano</option>
                            <option value="Boholano">Boholano</option>
                            <option value="Ilongo">Ilongo</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="display: none" id="show_other_ethnic_if_trigger">
                        <label>Other Ethnic Affiliation</label>
                        <input type="text" class="form-control rounded-0" placeholder="Indicate here!" id="other_ethnic_affiliation" name="other_ethnic_affiliation">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Current Address</label>
                        <input type="text" class="form-control rounded-0" required name="current_address">
                    </div>
                    <div class="col-md-6">
                        <label>Permanent Address</label>
                        <input type="text" class="form-control rounded-0" required name="permanent_address">
                    </div>
                </div>
                <br /> --}}
                <div class="row">
                    <div class="col-md-3">
                        <label style="font-weight: bold;">Personal Information</label>
                        <img id="blah" src="{{ asset('carmen_images/default_image.jpg') }}" class="img img-thumbnail"
                            alt="your image" />
                        <input accept="image/*" name="resident_image" class="form-control" type='file' id="imgInp" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>First Name</label>
                        <input type="text" name="first_name" placeholder="First Name" class="form-control rounded-0"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label>Middle Name</label>
                        <input type="text" placeholder="Middle Name" name="middle_name" class="form-control rounded-0"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label>Last Name</label>
                        <input type="text" placeholder="Last Name" id="last_name" name="last_name"
                            class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-3">
                        <label>Nickname</label>
                        <input type="text" placeholder="Nickname" id="nickname" name="nickname"
                            class="form-control rounded-0" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Tag Father</label>
                        <select name="father" style="width:100%;" id="father" class="js-example-basic-single form-control rounded-0" required>
                            <option value="" default>Select</option>
                            <option value="N/A">N/A</option>
                            <option value="input_father_name">Input Father Name</option>
                            @foreach ($residents as $data)
                                <option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->middle_name }}
                                    {{ $data->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Photo</label>
                        <div id="show_father_image"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Tag Mother</label>
                        <select name="mother" style="width:100%;" id="mother" class="js-example-basic-single form-control rounded-0" required>
                            <option value="" default>Select</option>
                            <option value="N/A">N/A</option>
                            @foreach ($residents as $data)
                                <option value="{{ $data->id }}">{{ $data->first_name }} {{ $data->middle_name }}
                                    {{ $data->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Photo</label>
                        <div id="show_mother_image"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Current Address</label>
                        <input type="text" class="form-control rounded-0" required name="current_address">
                    </div>
                    <div class="col-md-12">
                        <label>Permanent Address</label>
                        <input type="text" class="form-control rounded-0" required name="permanent_address">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Zone</label>
                        <select name="zone" class="form-control rounded-0">
                            <option value="" default>Select</option>
                            <option value="Zone 1">Zone 1</option>
                            <option value="Zone 2">Zone 2</option>
                            <option value="Zone 3">Zone 3</option>
                            <option value="Zone 4">Zone 4</option>
                            <option value="Zone 5">Zone 5</option>
                            <option value="Zone 6">Zone 6</option>
                            <option value="Zone 7">Zone 7</option>
                            <option value="Zone 8">Zone 8</option>
                            <option value="Zone 9">Zone 9</option>
                            <option value="Zone 10">Zone 10</option>
                            <option value="Zone 11">Zone 11</option>
                            <option value="Zone 12">Zone 12</option>
                            <option value="Zone 13">Zone 13</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Age</label>
                        <input type="text" name="dob" class="form-control rounded-0" required>
                    </div>
                    <div class="col-md-3">
                        <label>Place of birth</label>
                        <input type="text" id="place_of_birth" name="place_of_birth" class="form-control rounded-0"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label>Sex</label>
                        <select name="sex" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
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
                        <textarea name="pwd_description" id="pwd_description" class="form-control rounded-0"></textarea>
                    </div>
                </div>
                <div id="show_personnal_information"></div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm float-right btn-primary" type="submit"
                    style="margin-bottom: 10px;">Submit</button>
                {{-- <a class="btn btn-sm float-right btn-primary" id="registration_proceed"
                    style="margin-bottom: 10px;">Proceed</a> --}}
            </div>
        </form>
    </div>

@endsection
