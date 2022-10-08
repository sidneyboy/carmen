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

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="font-weight: bold;">BARANGAY OFFICIALS USER TYPE</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>User Type</label>
                        <input type="text" class="form-control rounded-0" required name="user_type">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm float-right btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
