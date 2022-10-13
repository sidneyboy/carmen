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

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-8">
            <div class="card" style="height:100%;">
                <div class="card-header" style="font-weight: bold;">POPULATION EVERY ZONE</div>
                <div class="card-body">
                    <canvas id="resident_per_zone_chart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height:100%;">
                <div class="card-header" style="font-weight: bold;">OVERALL GENDER DATA</div>
                <div class="card-body">
                    <canvas id="resident_gender" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="font-weight: bold;">PWD PER ZONE</div>
                <div class="card-body">
                    <canvas id="resident_pwd_chart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="font-weight: bold;">EDAD KADA ZONE TRIAL VERSION</div>
                <div class="card-body">
                    <canvas id="resident_age_chart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js">
    </script>

    <script type="text/javascript">
        const resident_per_zone_label = {!! json_encode($resident_per_zone_label) !!};
        const resident_per_zone_total = {!! json_encode($resident_per_zone_total) !!};

        new Chart("resident_per_zone_chart", {
            type: "bar",
            data: {
                labels: resident_per_zone_label,
                datasets: [{
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(153, 102, 255)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1,
                    data: resident_per_zone_total
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: "Agent Performance For the Month of ",
                    }
                }
            }
        });

        const resident_gender_label = {!! json_encode($resident_gender_label) !!};
        const resident_gender_total = {!! json_encode($resident_gender_total) !!};

        var pie_chart_data = [{
            data: resident_gender_total,
            backgroundColor: [
                "#4b77a9",
                "#5f255f",
                "#d21243",

            ],
            borderColor: "#fff"
        }];

        var options = {
            tooltips: {
                enabled: false
            },
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        const datapoints = ctx.chart.data.datasets[0].data
                        const total = datapoints.reduce((total, datapoint) => total + datapoint, 0)
                        const percentage = value / total * 100
                        return percentage.toFixed(2) + "%";
                    },
                    color: '#fff',
                },
                // legend: {
                //     display: false
                // },
                // title: {
                //     display: false,
                //     text: "Agent Performance For the Month of ",
                // }
            }

        };

        var resident_gender = document.getElementById("resident_gender").getContext('2d');
        var pie_chart = new Chart(resident_gender, {
            type: 'pie',
            data: {
                labels: resident_gender_label,
                datasets: pie_chart_data
            },
            options: options,
            plugins: [ChartDataLabels],
        });

        const pwd_per_zone_label = {!! json_encode($pwd_per_zone_label) !!};
        const pwd_per_zone_total = {!! json_encode($pwd_per_zone_total) !!};

        new Chart("resident_pwd_chart", {
            type: "bar",
            data: {
                labels: pwd_per_zone_label,
                datasets: [{
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(153, 102, 255)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1,
                    data: pwd_per_zone_total
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: "Agent Performance For the Month of ",
                    }
                }
            }
        });
    </script>

@endsection
