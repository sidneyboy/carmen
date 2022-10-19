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
        <div class="card-header" style="font-weight: bold;">BARANGAY COMPLAINS</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <label>Respondent</label>
                    <input type="text" name="complainant" id="complainant" class="form-control rounded-0" required>
                    <br />
                    <button id="proceed" class="btn btn-primary float-right btn-sm">Proceed</button>
                </div>
            </div>
        </div>
        <div class="card-footer">
           <div id="generate_respondent"></div>
        </div>
    </div>
@endsection
