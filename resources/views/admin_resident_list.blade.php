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
                        <th>resident_image</th>
                        <th>first_name</th>
                        <th>middle_name</th>
                        <th>last_name</th>
                        <th>nickname</th>
                        <th>dob</th>
                        <th>civil_status</th>
                        <th>More Info</th>
                    </thead>
                    <tbody>
                        @foreach ($residents as $data)
                            <tr>
                                <td>
                                    <a target="_blank" href="{{ url('admin_resident_show_map', ['id' => $data->id]) }}">
                                        <img src="{{ asset('/storage/' . $data->resident_image) }}"
                                            class="img img-thumbnail" style="width:100px;height:100px;">
                                    </a>
                                </td>
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->middle_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->nickname }}</td>
                                <td>
                                    @php
                                        $dateOfBirth = $data->dob;
                                        $today = date('Y-m-d');
                                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                        echo $diff->format('%y');
                                    @endphp
                                </td>
                                <td>{{ $data->civil_status }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#exampleModal_more_information{{ $data->id }}">
                                        Show
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_more_information{{ $data->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $data->first_name }}
                                                        {{ $data->middle_name }} {{ $data->last_name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class=" table table-striped table-hover table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>father</th>
                                                                    <th>mother</th>
                                                                    <th>place_of_birth</th>
                                                                    <th>sex</th>
                                                                    <th>nationality</th>
                                                                    <th>zone</th>
                                                                    <th>pwd</th>
                                                                    <th>pwd_description</th>
                                                                    <th>permanent_address</th>
                                                                    <th>current_address</th>
                                                                    <th>status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        @if ($data->father != null)
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button"
                                                                                class="btn btn-link btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModal_father_data{{ $data->id }}">
                                                                                {{ $data->father_data->first_name }}
                                                                                {{ $data->father_data->middle_name }}
                                                                                {{ $data->father_data->last_name }}
                                                                            </button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_father_data{{ $data->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-xl"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                father data</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <span
                                                                                                    aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="table table-responsive">
                                                                                                <table
                                                                                                    class="table table-striped table-hover"
                                                                                                    id="example">
                                                                                                    <thead>
                                                                                                        <th>resident_image
                                                                                                        </th>
                                                                                                        <th>first_name</th>
                                                                                                        <th>middle_name</th>
                                                                                                        <th>last_name</th>
                                                                                                        <th>nickname</th>
                                                                                                        <th>dob</th>
                                                                                                        <th>civil_status
                                                                                                        </th>
                                                                                                        <th>place_of_birth
                                                                                                        </th>
                                                                                                        <th>sex</th>
                                                                                                        <th>nationality</th>
                                                                                                        <th>zone</th>
                                                                                                        <th>pwd</th>
                                                                                                        <th>pwd_description
                                                                                                        </th>
                                                                                                        <th>permanent_address
                                                                                                        </th>
                                                                                                        <th>current_address
                                                                                                        </th>
                                                                                                        <th>status</th>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <a target="_blank"
                                                                                                                    href="{{ url('admin_resident_show_map', ['id' => $data->father_data->id]) }}">
                                                                                                                    <img src="{{ asset('/storage/' . $data->father_data->resident_image) }}"
                                                                                                                        class="img img-thumbnail"
                                                                                                                        style="width:100px;height:100px;">
                                                                                                                </a>
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->first_name }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->middle_name }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->last_name }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->nickname }}
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                @php
                                                                                                                    $dateOfBirth = $data->father_data->dob;
                                                                                                                    $today = date('Y-m-d');
                                                                                                                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                                                                                    echo $diff->format('%y');
                                                                                                                @endphp
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->civil_status }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->place_of_birth }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->sex }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->nationality }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->zone }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->pwd }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->pwd_description }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->status }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->permanent_address }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->father_data->current_address }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            None
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($data->father != null)
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button"
                                                                                class="btn btn-link btn-sm"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModal_mother_data{{ $data->id }}">
                                                                                {{ $data->mother_data->first_name }}
                                                                                {{ $data->mother_data->middle_name }}
                                                                                {{ $data->mother_data->last_name }}
                                                                            </button>

                                                                            <!-- Modal -->
                                                                            <div class="modal fade"
                                                                                id="exampleModal_mother_data{{ $data->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-xl"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Mother data</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <span
                                                                                                    aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div
                                                                                                class="table table-responsive">
                                                                                                <table
                                                                                                    class="table table-striped table-hover"
                                                                                                    id="example">
                                                                                                    <thead>
                                                                                                        <th>resident_image
                                                                                                        </th>
                                                                                                        <th>first_name</th>
                                                                                                        <th>middle_name</th>
                                                                                                        <th>last_name</th>
                                                                                                        <th>nickname</th>
                                                                                                        <th>dob</th>
                                                                                                        <th>civil_status
                                                                                                        </th>
                                                                                                        <th>place_of_birth
                                                                                                        </th>
                                                                                                        <th>sex</th>
                                                                                                        <th>nationality</th>
                                                                                                        <th>zone</th>
                                                                                                        <th>pwd</th>
                                                                                                        <th>pwd_description
                                                                                                        </th>
                                                                                                        <th>permanent_address
                                                                                                        </th>
                                                                                                        <th>current_address
                                                                                                        </th>
                                                                                                        <th>status</th>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <a target="_blank"
                                                                                                                    href="{{ url('admin_resident_show_map', ['id' => $data->mother_data->id]) }}">
                                                                                                                    <img src="{{ asset('/storage/' . $data->mother_data->resident_image) }}"
                                                                                                                        class="img img-thumbnail"
                                                                                                                        style="width:100px;height:100px;">
                                                                                                                </a>
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->first_name }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->middle_name }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->last_name }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->nickname }}
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                @php
                                                                                                                    $dateOfBirth = $data->mother_data->dob;
                                                                                                                    $today = date('Y-m-d');
                                                                                                                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                                                                                    echo $diff->format('%y');
                                                                                                                @endphp
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->civil_status }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->place_of_birth }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->sex }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->nationality }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->zone }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->pwd }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->pwd_description }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->status }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->permanent_address }}
                                                                                                            </td>
                                                                                                            <td>{{ $data->mother_data->current_address }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            None
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $data->place_of_birth }}</td>
                                                                    <td>{{ $data->sex }}</td>
                                                                    <td>{{ $data->nationality }}</td>
                                                                    <td>{{ $data->zone }}</td>
                                                                    <td>{{ $data->pwd }}</td>
                                                                    <td>{{ $data->pwd_description }}</td>
                                                                    <td>{{ $data->status }}</td>
                                                                    <td>{{ $data->permanent_address }}</td>
                                                                    <td>{{ $data->current_address }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
