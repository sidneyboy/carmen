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

    <div class="card" style="margin-bottom: 10px;">
        <div class="card-header" style="font-weight: bold;">BARANGAY COMPLAIN</div>
        <form action="{{ route('admin_complain_type_process') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Complainant</label>
                        <select name="complainant_id" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            @foreach ($residents as $data)
                                <option value="{{ $data->id }}">{{ $data->name }} {{ $data->middle_name }}
                                    {{ $data->last_name }} - {{ $data->nickname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Respondent</label>
                        <select name="complainant_id" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            @foreach ($residents as $data)
                                <option value="{{ $data->id }}">{{ $data->name }} {{ $data->middle_name }}
                                    {{ $data->last_name }} - {{ $data->nickname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Complain Type</label>
                        <select name="complain_type_id" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            @foreach ($complain_type as $data)
                                <option value="{{ $data->id }}">{{ $data->complain_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Date of Hearing</label>
                        <input type="date" class="form-control" name="date_of_hearing" required>
                    </div>
                    <div class="col-md-4">
                        <label for="">Time</label>
                        <input type="time" class="form-control" name="time" required>
                    </div>
                    <div class="col-md-4">
                        <label for="">Lupon</label>
                        <select name="lupon" class="form-control rounded-0" required>
                            <option value="" default>Select</option>
                            @foreach ($lupon as $data)
                                <option value="{{ $data->id }}">{{ $data->name }} {{ $data->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="">Reason</label>
                        <textarea name="Reason" class="form-control rounded-0" name="reason"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm float-right btn-primary">Save</button>
            </div>
        </form>
    </div>

    {{-- <div class="card">
        <div class="card-header">
            <h6>BARANGAY COMPLAIN TYPE LIST</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Complain Type</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complain_type as $data)
                        <tr>
                            <td>{{ $data->complain_type }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#exampleModal{{ $data->id }}">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Complain Type</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ url('complain_type_edit') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="text" value="{{ $data->complain_type }}" required
                                                        class="form-control" name="complain_type">
                                                    <input type="hidden" value="{{ $data->id }}" name="complain_id">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
@endsection
