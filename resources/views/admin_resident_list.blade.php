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
        <div class="card-header" style="font-weight: bold;">BARANGAY RESIDENT LIST</div>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-striped table-hover" id="example">
                    <thead>
                        <th>first_name</th>
                        <th>middle_name</th>
                        <th>last_name</th>
                        <th>nickname</th>
                        <th>dob</th>
                        <th>civil_status</th>
                        <th>Zone</th>
                        <th>Complain</th>
                        <th>More Info</th>
                    </thead>
                    <tbody>
                        @foreach ($residents as $data)
                            <tr>
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->middle_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->nickname }}</td>
                                <td>{{ $data->dob }}</td>
                                <td>{{ $data->civil_status }}</td>
                                <td>{{ $data->zone }}</td>
                                <td>
                                    @if ($data->complain_status == null)
                                        none
                                    @else
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-info btn-block rounded-0" data-toggle="modal"
                                            data-target="#exampleModal_complain_history{{ $data->id }}">
                                            {{ $data->complain_has_one->complain_status }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_complain_history{{ $data->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <label for="">Complainant</label>
                                                        <input type="text" class="form-control rounded-0"
                                                            value="{{ $data->complain_has_one->complainant_data->first_name }} {{ $data->complain_has_one->complainant_data->middle_name }} {{ $data->complain_has_one->complainant_data->last_name }}"
                                                            disabled>

                                                        <label for="">Respondent</label>
                                                        <input type="text" class="form-control rounded-0"
                                                            value="{{ $data->complain_has_one->respondent_data->first_name }} {{ $data->complain_has_one->respondent_data->middle_name }} {{ $data->complain_has_one->respondent_data->last_name }}"
                                                            disabled>

                                                        <label for="">Reason</label>
                                                        <textarea name="" disabled id="" class="form-control rounded-0" cols="30" rows="10">{{ $data->complain_has_one->reason }}</textarea>

                                                        <label for="">Complain Status</label>
                                                        <input type="text" disabled class="form-control rounded-0"
                                                            value="{{ $data->complain_has_one->complain_status }}">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td><a href="{{ url('show_resident_data', ['id' => $data->id]) }}">Show Data</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
