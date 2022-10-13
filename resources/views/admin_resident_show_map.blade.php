<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Resident Map Guide</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('open_layers_libs/v6.5.0/css/ol.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('open_layers_libs/v6.5.0/examples/resources/layout.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('open_layers_libs/ol-layerswitcher/dist/ol-layerswitcher.css') }}" />

    <script src="{{ asset('open_layers_libs/v6.5.0/build/ol.js') }}"></script>
    <script src="{{ asset('open_layers_libs/ol-layerswitcher/dist/ol-layerswitcher.js') }}"></script>

    <style>
        #map {
            position:absolute;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>

   
    <input type="hidden" id="lat" value="{{ $residents->latitude }}">
    <input type="hidden" id="lon" value="{{ $residents->longitude }}">
    <input type="hidden" id="marker_image" value="{{ asset('carmen_images/pin.png') }}">
    <div id="map" class="map"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        var marker_image = $('#marker_image').val();
        var lat = $('#lat').val();
        var lon = $('#lon').val();
        var view = new ol.View({
            projection: 'EPSG:4326',
            center: [lat, lon],
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
                maxZoom: 23
            })
        });

        var base_maps = new ol.layer.Group({
            title: 'Base Maps',
            layers: [satellite, OSM]
        })

        var map = new ol.Map({
            target: 'map',
            view: view
        })

        map.addLayer(base_maps);

        var layerSwitcher = new ol.control.LayerSwitcher({
            activationMode: 'click',
            startActive: true,
            tipLbel: 'Layers',
            groupSelectstyle: 'children',
            collapseTipLabel: 'Collapse Layer'
        });
        map.addControl(layerSwitcher);
        layerSwitcher.renderPanel();



        var Style = new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 46],
                anchorXUnits: 'fraction',
                anchorYUnits: 'pixels',
                src: marker_image,
            }),
        })

        var marker = new ol.Feature({
            geometry: new ol.geom.Point([lat, lon]),
            type: 'COWD',
            name: 'test'
        });

        var vectorLayer = new ol.layer.Vector({
            title: 'REPORT',
            source: new ol.source.Vector({
                features: [marker]
            }),
            style: Style
        });
        map.addLayer(vectorLayer);
    </script>
</body>

</html>
