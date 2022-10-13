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
                {{-- <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ Nav::isRoute('home') }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('Dashboard') }}</span></a>
                </li> --}}

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Functions
                </div>

                <!-- Nav Item - Profile -->


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
                <li class="nav-item {{ Nav::isRoute('admin_add_complain_type') }}">
                    <a class="nav-link" href="{{ route('admin_add_complain_type') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('BRGY Complain Type') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Nav::isRoute('complain') }}">
                    <a class="nav-link" href="{{ route('complain') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('BRGY Complain') }}</span>
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
                                {{-- <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Settings') }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Activity Log') }}
                                </a> --}}
                                {{-- <div class="dropdown-divider"></div> --}}
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

                    @yield('main-content')

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
            $('#example').DataTable({
                // dom: 'Bfrtip',
                // buttons: [
                //     'excel',
                // ]
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
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





        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
            alert(position.coords.longitude);
        }
    </script>




    <script type="text/javascript">
        var marker_image = $('#marker_image').val();
        var view = new ol.View({
            projection: 'EPSG:4326',
            center: [124.64968373253942, 8.483439232308356],
            zoom: 13,
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

        document.getElementById('export-png').addEventListener('click', function() {
            map.once('rendercomplete', function() {
                var mapCanvas = document.createElement('canvas');
                var size = map.getSize();
                mapCanvas.width = size[0];
                mapCanvas.height = size[1];
                var mapContext = mapCanvas.getContext('2d');
                Array.prototype.forEach.call(
                    document.querySelectorAll('.ol-layer canvas'),
                    function(canvas) {
                        if (canvas.width > 0) {
                            var opacity = canvas.parentNode.style.opacity;
                            mapContext.globalAlpha = opacity === '' ? 1 : Number(opacity);
                            var transform = canvas.style.transform;
                            // Get the transform parameters from the style's transform matrix
                            var matrix = transform
                                .match(/^matrix\(([^\(]*)\)$/)[1]
                                .split(',')
                                .map(Number);
                            // Apply the transform to the export map context
                            CanvasRenderingContext2D.prototype.setTransform.apply(
                                mapContext,
                                matrix
                            );
                            mapContext.drawImage(canvas, 0, 0);
                        }
                    }
                );
                if (navigator.msSaveBlob) {
                    // link download attribuute does not work on MS browsers
                    navigator.msSaveBlob(mapCanvas.msToBlob(), 'map.png');
                } else {
                    var link = document.getElementById('image-download');
                    link.href = mapCanvas.toDataURL();
                    link.click();
                }
            });

            $('#export-png').hide();
            $('#show_submit').show();
            map.renderSync();
        });
    </script>


</body>

</html>
