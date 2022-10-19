<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ROBI</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('open_layers_libs/v6.5.0/css/ol.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('open_layers_libs/v6.5.0/examples/resources/layout.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('open_layers_libs/ol-layerswitcher/dist/ol-layerswitcher.css') }}" />

    <script src="{{ asset('open_layers_libs/v6.5.0/build/ol.js') }}"></script>
    <script src="{{ asset('open_layers_libs/ol-layerswitcher/dist/ol-layerswitcher.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">

    <style>
        h2 {
            width: 100%;
            text-align: center;
            border-bottom: 3px solid #000;
            line-height: 0.1em;
            margin: 10px 0 20px;
            font-size: 20px;
        }

        h2 span {
            background: #fff;
            padding: 0 10px;
        }
    </style>
    <style>
        #map {
            width: 100%;
            height: 300px;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text">BRGY CARMEN-ROBI</div>
            </a>
            @if ($user->user_type == 'Super_user')
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Functions
                </div>

                <li class="nav-item {{ Nav::isRoute('admin_barangay_officials_registration') }}">
                    <a class="nav-link" href="{{ route('admin_barangay_officials_registration') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('BRGY Officials Reg') }}</span>
                    </a>
                </li>
            @elseif($user->user_type == 'Monitoring')
                <div class="sidebar-heading">
                    Functions
                </div>

                <li class="nav-item {{ Nav::isRoute('admin_resident_analytics') }}">
                    <a class="nav-link" href="{{ route('admin_resident_analytics') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('Analytics') }}</span></a>
                </li>


                <li class="nav-item {{ Nav::isRoute('admin_register_residents') }}">
                    <a class="nav-link" href="{{ route('admin_register_residents') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('BRGY Resident Reg') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Nav::isRoute('admin_resident_list') }}">
                    <a class="nav-link" href="{{ route('admin_resident_list') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('BRGY Resident List') }}</span>
                    </a>
                </li>
            @elseif($user->user_type == 'Lupon')
                <li class="nav-item {{ Nav::isRoute('lupon_complain') }}">
                    <a class="nav-link" href="{{ route('lupon_complain') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('BRGY Complains') }}</span>
                    </a>
                </li>
            @elseif ($user->user_type == 'Live Monitoring')
                <li class="nav-item {{ Nav::isRoute('admin_register_residents') }}">
                    <a class="nav-link" href="{{ route('admin_register_residents') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('BRGY Resident Reg') }}</span>
                    </a>
                </li>
            @endif



            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                        @if (session('success'))
                            <div class="alert alert-success border-left-success alert-dismissible fade show"
                                role="alert">
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

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header" style="font-weight: bold;">BARANGAY RESIDENT <a
                                            href="{{ url('admin_resident_show_map', ['id' => $resident_data->id]) }}"
                                            target="_blank">SHOW
                                            MAP</a></div>

                                    <form action="{{ route('resident_update_process') }}" method="post">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <input type="hidden" value="{{ $resident_data->id }}" name="id">
                                                <div class="col-md-3">
                                                    <label>First Name</label>
                                                    <input type="text" name="first_name"
                                                        value="{{ $resident_data->first_name }}" placeholder="First Name"
                                                        class="form-control rounded-0" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Middle Name</label>
                                                    <input type="text" value="{{ $resident_data->middle_name }}"
                                                        placeholder="Middle Name" name="middle_name"
                                                        class="form-control rounded-0" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Last Name</label>
                                                    <input type="text" value="{{ $resident_data->last_name }}"
                                                        placeholder="Last Name" id="last_name" name="last_name"
                                                        class="form-control rounded-0" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Nickname</label>
                                                    <input type="text" value="{{ $resident_data->nickname }}"
                                                        placeholder="Nickname" id="nickname" name="nickname"
                                                        class="form-control rounded-0" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Current Address</label>
                                                    <input type="text" value="{{ $resident_data->current_address }}"
                                                        class="form-control rounded-0" required name="current_address">
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Permanent Address</label>
                                                    <input type="text" value="{{ $resident_data->permanent_address }}"
                                                        class="form-control rounded-0" required name="permanent_address">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Zone</label>
                                                    <select name="zone" class="form-control rounded-0">
                                                        <option value="" default>Select</option>
                                                        <option value="{{ $resident_data->zone }}" selected>
                                                            {{ $resident_data->zone }}
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
                                                    <input type="text" value="{{ $resident_data->dob }}"
                                                        name="dob" class="form-control rounded-0" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Place of birth</label>
                                                    <input type="text" value="{{ $resident_data->place_of_birth }}"
                                                        id="place_of_birth" name="place_of_birth"
                                                        class="form-control rounded-0" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Sex</label>
                                                    <select name="sex" class="form-control rounded-0" required>
                                                        <option value="" default>Select</option>
                                                        <option value="{{ $resident_data->sex }}" selected>
                                                            {{ $resident_data->sex }}</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Nationality</label>
                                                    <input type="text" name="nationality"
                                                        value="{{ $resident_data->nationality }}"
                                                        class="form-control rounded-0" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Civil Status</label>
                                                    <select name="civil_status" class="form-control rounded-0" required>
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
                                                    <select name="pwd" id="pwd" class="form-control rounded-0"
                                                        required>
                                                        <option value="" default>Select</option>
                                                        <option value="{{ $resident_data->pwd }}" selected>
                                                            {{ $resident_data->pwd }}</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12" style="display: none" id="show_trigger">
                                                    <label>PWD Description</label>
                                                    <textarea name="pwd_description" id="pwd_description" class="form-control rounded-0">{{ $resident_data->pwd_description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control rounded-0"
                                                        value="{{ $resident_data->occupation }}" name="occupation"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Sub Zone</label>
                                                    <input type="text" class="form-control rounded-0"
                                                        value="{{ $resident_data->sub_zone }}" name="sub_zone" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Senior Citizen</label>
                                                    <select name="senior_citizen" class="form-control rounded-0" required>
                                                        <option value="" default>Select</option>
                                                        <option value="{{ $resident_data->senior_citizen }}" selected>
                                                            {{ $resident_data->senior_citizen }}</option>
                                                        <option value="yes">yes</option>
                                                        <option value="no">no</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Relationship to household head</label>
                                                    <input type="text"
                                                        value="{{ $resident_data->relationship_to_household_head }}"
                                                        name="relationship_to_household_head"
                                                        class="form-control rounded-0" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-info float-left"
                                                data-toggle="modal" data-target="#exampleModal">
                                                Complain History
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">History</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
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
                                                                        @foreach ($complain_many as $complain_many_data)
                                                                            <tr>
                                                                                <td>{{ $complain_many_data->complainant_data->first_name }}
                                                                                    {{ $complain_many_data->complainant_data->middle_name }}
                                                                                    {{ $complain_many_data->complainant_data->last_name }}
                                                                                </td>
                                                                                <td>{{ $complain_many_data->respondent_data->first_name }}
                                                                                    {{ $complain_many_data->respondent_data->middle_name }}
                                                                                    {{ $complain_many_data->respondent_data->last_name }}
                                                                                </td>
                                                                                <td>{{ $complain_many_data->reason }}</td>
                                                                                <td>{{ $complain_many_data->complain_status }}
                                                                                </td>
                                                                                <td>{{ date('F j, Y h:i a', strtotime($complain_many_data->created_at)) }}
                                                                                </td>
                                                                                @if ($complain_many_data->complain_status == 'settled')
                                                                                    <td>{{ date('F j, Y h:i a', strtotime($complain_many_data->updated_at)) }}
                                                                                    </td>
                                                                                @else
                                                                                    <td></td>
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

                                            <button type="submit"
                                                class="btn btn-sm btn-primary float-right">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset('/storage/' . $resident_data->resident_image) }}"
                                            class="img img-thumbnail" alt="">
                                    </div>
                                    <div class="card-footer">
                                        <form action="{{ route('residet_update_image_process') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ $resident_data->id }}" name="id">
                                            <input type="file" class="form-control rounded-0" name="resident_image"
                                                required>
                                            <br />
                                            <button class="btn btn-primary float-right btn-sm">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="col-md-12" style="margin-top:10px;">
                                <div class="card">
                                    <div class="card-header">Resident Location</div>
                                    <div class="card-body">
                                        <div id="map"></div>
                                        <input type="hidden" value="{{ asset('/carmen_images/pin.png') }}"
                                            id="marker_image">
                                    </div>
                                    <form action="{{ route('edit_location') }}" method="post">
                                        @csrf
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Latitude</label>
                                                    <input type="text" value="{{ $resident_data->latitude }}" class="form-control rounded-0" name="latitude"
                                                        id="latitude">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Longitude</label>
                                                    <input type="text" value="{{ $resident_data->longitude }}" class="form-control rounded-0" name="longitude"
                                                        id="longitude">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <input type="hidden" value="{{ $resident_data->id }}" name="resident_id">
                                            <button class="btn btn-primary btn-sm float-right">Save New Location</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <br /><br />

 

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Alejandro RH {{ now()->year }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>





    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $(document).ready(function() {
            $('#example').DataTable({});


            $('.js-example-basic-single').select2();


            $("#proceed").click(function() {
                var complainant = $('#complainant').val();
                $.post({
                    type: "POST",
                    url: "/lupon_generate_respondent",
                    data: 'complainant=' + complainant,
                    success: function(data) {
                        console.log(data);
                        $('#generate_respondent').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


            $("#family_name").keyup(function() {
                $('#father_last_name').val($('#family_name').val());
            });

            $("#pwd").change(function() {
                if ($(this).val() == 'Yes') {
                    $('#show_trigger').show();
                } else {
                    $('#show_trigger').hide();
                }
            });

            $("#mother_pwd").change(function() {
                if ($(this).val() == 'Yes') {
                    $('#mother_show_trigger').show();
                } else {
                    $('#mother_show_trigger').hide();
                }
            });

            $("#ethnic_origin").click(function() {
                if ($(this).val() == 'Others') {
                    $('#show_other_ethnic_if_trigger').show();
                } else {
                    $('#show_other_ethnic_if_trigger').hide();
                }
            });

            $("#registration_proceed").click(function() {
                var number_of_childrens = $('#number_of_childrens').val();
                $.post({
                    type: "POST",
                    url: "/admin_registration_residents_generate_number_of_childrens",
                    data: 'number_of_childrens=' + number_of_childrens,
                    success: function(data) {
                        console.log(data);
                        $('#show_personnal_information').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }

            $("#father").change(function() {
                var father_id = $('#father').val();
                $.post({
                    type: "POST",
                    url: "/admin_search_father",
                    data: 'father_id=' + father_id,
                    success: function(data) {
                        console.log(data);
                        $('#show_father_image').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $("#mother").change(function() {
                var mother_id = $('#mother').val();
                $.post({
                    type: "POST",
                    url: "/admin_search_mother",
                    data: 'mother_id=' + mother_id,
                    success: function(data) {
                        console.log(data);
                        $('#show_mother_image').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


        });

        // $(document).ready(function() {

        // });
    </script>




    <script type="text/javascript">
            // $('#latitude').val(position.coords.latitude);
            // $('#longitude').val(position.coords.longitude);
            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            
            var marker_image = $('#marker_image').val();
            var view = new ol.View({
                projection: 'EPSG:4326',
                center: [latitude, longitude],
                zoom: 18,
                maxZoom: 23,
            })


            var OSM = new ol.layer.Tile({
                title: 'OSM',
                type: 'base',
                visible: true,
                source: new ol.source.OSM()
            });

            var satellite = new ol.layer.Tile({
                title: 'satellite',
                type: 'base',
                visible: true,
                source: new ol.source.XYZ({
                    attributions: ['Powered by Esri',
                        'Source: Esri, DigitalGlobe, GeoEye, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, AeroGRID, IGN, and the GIS User Community'
                    ],
                    attributionsCollapsible: true,
                    url: 'http://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}',
                    maxZoom: 23,
                    crossOrigin: "Anonymous"
                })
            });

            var base_maps = new ol.layer.Group({
                title: 'Base Maps',
                layers: [satellite]
            })

            var map = new ol.Map({
                target: 'map',
                view: view
            })

            map.addLayer(base_maps);

            var marker_image = $('#marker_image').val();

            var Style = new ol.style.Style({
                image: new ol.style.Icon({
                    anchor: [0.5, 46],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    src: marker_image,
                }),
            })

            var checker = checker;

            map.on('click', function(e) {
                if (checker > 0) {
                    console.log('cannot');
                } else {
                    var point = map.getCoordinateFromPixel(e.pixel)
                    console.log(e.coordinate);
                    $('#longitude').val(e.coordinate[0]);
                    $('#latitude').val(e.coordinate[1]);


                    var marker = new ol.Feature({
                        geometry: new ol.geom.Point([e.coordinate[0], e.coordinate[1]]),
                        type: 'hospital',
                        name: 'test',
                    });

                    var vectorLayer = new ol.layer.Vector({
                        title: 'REPORT',
                        source: new ol.source.Vector({
                            features: [marker]
                        }),
                        style: Style
                    });
                    map.addLayer(vectorLayer);



                    function utmzone_from_lon(lon_deg) {
                        //get utm-zone from longitude degrees
                        return parseInt(((lon_deg + 180) / 6) % 60) + 1;
                    }

                    function proj4_setdef(lon_deg) {
                        //get UTM projection definition from longitude
                        const utm_zone = utmzone_from_lon(lon_deg);
                        const zdef = `+proj=utm +zone=${utm_zone} +datum=WGS84 +units=m +no_defs`;
                        return zdef;
                    }

                    // computation test
                    let lon_input = e.coordinate[0];
                    let lat_input = e.coordinate[1];
                    console.log("Input (long,lat):", lon_input, lat_input);
                    const azone = utmzone_from_lon(lon_input);
                    console.log(`UTM zone from longitude: ${azone}`);
                    console.log("AUTO projection definition:", proj4_setdef(lon_input));

                    // define proj4_defs for easy uses
                    // "EPSG:4326" for long/lat degrees, no projection
                    // "EPSG:AUTO" for UTM 'auto zone' projection
                    proj4.defs([
                        [
                            "EPSG:4326",
                            "+title=WGS 84 (long/lat) +proj=longlat +ellps=WGS84 +datum=WGS84 +units=degrees"
                        ],
                        ["EPSG:AUTO", proj4_setdef(lon_input)]
                    ]);

                    // usage:
                    // conversion from (long/lat) to UTM (E/N)
                    const en_m = proj4("EPSG:4326", "EPSG:AUTO", [lon_input, lat_input]);
                    const e4digits = en_m[0].toFixed(4); //easting
                    const n4digits = en_m[1].toFixed(4); //northing
                    console.log(`Zone ${azone}, (E,N) m: ${e4digits}, ${n4digits}`);


                    $('#x_axis').val(e4digits);
                    $('#y_axis').val(n4digits);

                    // inversion from (E,N) to (long,lat)
                    const lonlat_chk = proj4("EPSG:AUTO", "EPSG:4326", en_m);
                    console.log("Inverse check:", lonlat_chk);

                    checker = 1;
                }
            });


            function removeMarker() {
                location.reload();
            }
    </script>


</body>

</html>
