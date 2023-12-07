@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('css')
    <style>
        .info-box-text {
            font-weight: 15px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Penduduk Domisili Berdasarkan Kriteria</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Balita</span>
                    <span class="info-box-number">{{ $jumlahBalita }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Kanak-kanak</span>
                    <span class="info-box-number">{{ $jumlahKanak }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Remaja</span>
                    <span class="info-box-number">{{ $jumlahRemaja }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Dewas</span>
                    <span class="info-box-number">{{ $jumlahDewasa }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fas fa-tag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Lansia</span>
                    <span class="info-box-number">{{ $jumlahLansia }}</span>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var areaChartData = {
                labels: @json($listNama),
                datasets: [{
                        label: 'Laki-laki',
                        backgroundColor: 'rgb(0, 150, 255)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: @json($listJumlahPria)
                    },
                    {
                        label: 'Perempuan',
                        backgroundColor: 'rgb(255, 82, 82)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: @json($listJumlahPerempuan)
                    },
                ]
            }

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        });
    </script>
@endpush
