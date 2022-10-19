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
    {{-- 
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <li>Please pin in the map the exact location of resident</li>
            </ul>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-weight: bold;">BARANGAY RESIDENT <a
                        href="{{ url('admin_resident_show_map', ['id' => $resident_data->id]) }}" target="_blank">SHOW
                        MAP</a></div>
                {{-- @if ($message = Session::get('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ Session::get('success') }}
                    </div>
                @endif --}}
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" value="{{ $resident_data->id }}" name="id">
                        <div class="col-md-3">
                            <label>First Name</label>
                            <input type="text" disabled name="first_name" value="{{ $resident_data->first_name }}"
                                placeholder="First Name" class="form-control rounded-0" required>
                        </div>
                        <div class="col-md-3">
                            <label>Middle Name</label>
                            <input type="text" disabled value="{{ $resident_data->middle_name }}"
                                placeholder="Middle Name" name="middle_name" class="form-control rounded-0" required>
                        </div>
                        <div class="col-md-3">
                            <label>Last Name</label>
                            <input type="text" disabled value="{{ $resident_data->last_name }}" placeholder="Last Name"
                                id="last_name" name="last_name" class="form-control rounded-0" required>
                        </div>
                        <div class="col-md-3">
                            <label>Nickname</label>
                            <input type="text" disabled value="{{ $resident_data->nickname }}" placeholder="Nickname"
                                id="nickname" name="nickname" class="form-control rounded-0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Current Address</label>
                            <input type="text" disabled value="{{ $resident_data->current_address }}"
                                class="form-control rounded-0" required name="current_address">
                        </div>
                        <div class="col-md-12">
                            <label>Permanent Address</label>
                            <input type="text" disabled value="{{ $resident_data->permanent_address }}"
                                class="form-control rounded-0" required name="permanent_address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Zone</label>
                            <select name="zone" disabled class="form-control rounded-0">
                                <option value="" default>Select</option>
                                <option value="{{ $resident_data->zone }}" selected>{{ $resident_data->zone }}
                                </option>
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
                            <input type="text" disabled value="{{ $resident_data->dob }}" name="dob"
                                class="form-control rounded-0" required>
                        </div>
                        <div class="col-md-3">
                            <label>Place of birth</label>
                            <input type="text" disabled value="{{ $resident_data->place_of_birth }}" id="place_of_birth"
                                name="place_of_birth" class="form-control rounded-0" required>
                        </div>
                        <div class="col-md-3">
                            <label>Sex</label>
                            <select name="sex" disabled class="form-control rounded-0" required>
                                <option value="" default>Select</option>
                                <option value="{{ $resident_data->sex }}" selected>{{ $resident_data->sex }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Nationality</label>
                            <input type="text" disabled name="nationality" value="{{ $resident_data->nationality }}"
                                class="form-control rounded-0" required>
                        </div>
                        <div class="col-md-4">
                            <label>Civil Status</label>
                            <select name="civil_status" disabled class="form-control rounded-0" required>
                                <option value="" default>Select</option>
                                <option value="{{ $resident_data->civil_status }}" selected>
                                    {{ $resident_data->civil_status }}</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>PWD</label>
                            <select name="pwd" disabled id="pwd" class="form-control rounded-0" required>
                                <option value="" default>Select</option>
                                <option value="{{ $resident_data->pwd }}" selected>{{ $resident_data->pwd }}</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-12" style="display: none" id="show_trigger">
                            <label>PWD Description</label>
                            <textarea name="pwd_description" disabled id="pwd_description" class="form-control rounded-0">{{ $resident_data->pwd_description }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Occupation</label>
                            <input type="text" disabled class="form-control rounded-0"
                                value="{{ $resident_data->occupation }}" name="occupation" required>
                        </div>
                        <div class="col-md-6">
                            <label>Sub Zone</label>
                            <input type="text" disabled class="form-control rounded-0"
                                value="{{ $resident_data->sub_zone }}" name="sub_zone" required>
                        </div>
                        <div class="col-md-6">
                            <label>Senior Citizen</label>
                            <select name="senior_citizen" disabled class="form-control rounded-0" required>
                                <option value="" default>Select</option>
                                <option value="{{ $resident_data->senior_citizen }}" selected>
                                    {{ $resident_data->senior_citizen }}</option>
                                <option value="yes">yes</option>
                                <option value="no">no</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Relationship to household head</label>
                            <input type="text" disabled value="{{ $resident_data->relationship_to_household_head }}"
                                name="relationship_to_household_head" class="form-control rounded-0" required>
                        </div>
                        {{-- <div class="col-md-6">
                            <label>Complain Status</label>
                            @if ($resident_data->complain_status == null)
                                <input type="text" class="form-control rounded-0" disabled value="none">
                            @else
                                <input type="text" class="form-control rounded-0" disabled
                                    value="{{ $resident_data->complain_has_one->complain_status }}">
                            @endif
                        </div> --}}
                        {{-- @if ($resident_data->complain_status == null)
                        @else --}}
                        <div class="col-md-12">
                            <label for="">&nbsp;</label>
                            <br />
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-block rounded-0" data-toggle="modal"
                                data-target="#exampleModal_complain_history">
                                Complain Report
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_complain_history" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    @foreach ($complain_many as $complain_many_data)
                                        <div class="modal-content" style="margin-bottom: 10px;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Complain #
                                                    {{ $complain_many_data->id }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="">Complainant</label>
                                                <input type="text" class="form-control rounded-0"
                                                    value="{{ $complain_many_data->complainant_data->first_name }} {{ $complain_many_data->complainant_data->middle_name }} {{ $complain_many_data->complainant_data->last_name }}"
                                                    disabled>

                                                <label for="">Respondent</label>
                                                <input type="text" class="form-control rounded-0"
                                                    value="{{ $complain_many_data->respondent_data->first_name }} {{ $complain_many_data->respondent_data->middle_name }} {{ $complain_many_data->respondent_data->last_name }}"
                                                    disabled>

                                                <label for="">Reason</label>
                                                <textarea name="" disabled id="" class="form-control rounded-0" cols="30" rows="10">{{ $complain_many_data->reason }}</textarea>

                                                <label for="">Complain Status</label>
                                                <input type="text" disabled class="form-control rounded-0"
                                                    value="{{ $complain_many_data->complain_status }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <a href="{{ url('lupon_change_complain_status', ['id' => $complain_many_data->id]) }}"
                                                    class="btn btn-sm btn-success">Settled</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="card-footer">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-info float-left" data-toggle="modal"
                        data-target="#exampleModal_complain_history_data">
                        Complain History
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal_complain_history_data" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">History</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table table-responsive">
                                        <table class="table table-striped table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Complainant</th>
                                                    <th>Respondent</th>
                                                    <th>Reasons</th>
                                                    <th>Complain Status</th>
                                                    <th>Created At</th>
                                                    <th>Settled At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($complain_history as $complain_many_data)
                                                    <tr>
                                                        <td>{{ $complain_many_data->complainant_data->first_name }}
                                                            {{ $complain_many_data->complainant_data->middle_name }}
                                                            {{ $complain_many_data->complainant_data->last_name }}</td>
                                                        <td>{{ $complain_many_data->respondent_data->first_name }}
                                                            {{ $complain_many_data->respondent_data->middle_name }}
                                                            {{ $complain_many_data->respondent_data->last_name }}</td>
                                                        <td>{{ $complain_many_data->reason }}</td>
                                                        <td>{{ $complain_many_data->complain_status }}</td>
                                                        <td>{{ date('F j, Y h:i a', strtotime($complain_many_data->created_at)) }}
                                                        </td>
                                                        @if ($complain_many_data->complain_status == 'settled')
                                                            <td>{{ date('F j, Y h:i a', strtotime($complain_many_data->updated_at)) }}
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <label for="">&nbsp;</label>
                    <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                        data-target="#exampleModal">
                        Add Complain
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Complainant Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('complain_process') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="">Complainant</label>
                                        <select name="complainant_id" class="form-control rounded-0" required>
                                            <option value="" default>Select</option>
                                            @foreach ($respondent as $respondent_data)
                                                <option value="{{ $respondent_data->id }}">
                                                    {{ $respondent_data->first_name }}
                                                    {{ $respondent_data->middle_name }}
                                                    {{ $respondent_data->last_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <input type="hidden" value="{{ $respondent_id }}" name="respondent_id">

                                        <label for="">Reason</label>
                                        <textarea name="reason" class="form-control rounded-0" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-sm btn-primary">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('/storage/' . $resident_data->resident_image) }}" class="img img-thumbnail"
                        alt="">
                </div>
            </div>
        </div>
    </div>


    <br /><br />
@endsection
