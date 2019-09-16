@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row gutter-xs">
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-primary no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Penjualan Tiket Per Hari</small>
                                <h3 class="card-title fw-l">
                                    @if($hari == 0)
                                        {{ 0 }}
                                    @else
                                        {{ $hari }}
                                    @endif
                                </h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [25250, 23370, 25568, 28961, 26762, 30072, 25135]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 31072}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-danger no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Pemasukan Tiket Per Hari</small>
                                <h3 class="card-title fw-l">Rp. {{ number_format($totalUang, 0 , ".", ".") }}</h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [8796, 11317, 8678, 9452, 8453, 11853, 9945]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 12742}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-info no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Penjualan Tiket Online Per Hari</small>
                                <h3 class="card-title fw-l">
                                    @if($hari2 == 0)
                                        {{ 0 }}
                                    @else
                                        {{ $hari2 }}
                                    @endif
                                </h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [116196, 145160, 124419, 147004, 134740, 120846, 137225]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 158029}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-warning no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Saldo Terbaru di Bank</small>
                                <h3 class="card-title fw-l">Rp. 0</h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [13590442, 12362934, 13639564, 13055677, 12915203, 11009940, 11542408]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 14662531}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutter-xs">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Penjualan Tiket Per Hari</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-chart">
                                <canvas id="myChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Penjualan Tiket Per Bulan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart1" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(document).ready(function () {
            var url = "{{ URL('dashboard/chart') }}";
            var jumlah = [];
            var url1 = "{{ URL('dashboard/chart1') }}";
            var jumlah1 = [];
            var bulan = [];
            var tanggal = [];

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                url: url,
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    for (var i in data) {
                        jumlah.push(data[i].jumlah);
                        tanggal.push(data[i].tanggal);
                    }
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: tanggal,
                            datasets: [{
                                label: 'Penjualan tiket',
                                data: jumlah,
                                backgroundColor: "#f25f2c",
                                borderColor: "#f25f2c",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    alert(status + " : " + error);
                }
            });

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                url: url1,
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    for (var i in data) {
                        jumlah1.push(data[i].jumlah);
                        bulan.push(data[i].bulan);
                    }
                    var ctx = document.getElementById("myChart1").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: bulan,
                            datasets: [{
                                label: 'Penjualan tiket',
                                data: jumlah1,
                                backgroundColor: "#7c55fb",
                                borderColor: "#7c55fb",
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    alert(status + " : " + error);
                }
            });
        });
    </script>
@endpush
