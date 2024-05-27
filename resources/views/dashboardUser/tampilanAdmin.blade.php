@extends('dashboardAdmin')

@section('content')
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-card {
            max-width: 100%;
        }
        .chart-container {
            position: relative;
            height: 300px; /* Mengurangi tinggi diagram untuk memperkecil */
        }
        .chart-inner {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="content-header">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <!-- Card for Projects in Progress -->
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Projek Sedang Dikerjakan</h5>
                        <p class="card-text">{{ $sedangDikerjakan }}</p>
                    </div>
                </div>
            </div>

            <!-- Card for Completed Projects -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Projek Selesai</h5>
                        <p class="card-text">{{ $selesai }}</p>
                    </div>
                </div>
            </div>

            <!-- Card for Cancelled Projects -->
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Projek Dibatalkan</h5>
                        <p class="card-text">{{ $dibatalkan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Bar Chart for Project Progress -->
            <div class="col-md-6">
                <div class="card mb-3 chart-card">
                    <div class="card-body">
                        <h5 class="card-title">Progres Projek Sedang Dikerjakan</h5>
                        <div class="chart-container">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Doughnut Chart for Project Status Comparison -->
            <div class="col-md-6">
                <div class="card mb-3 chart-card">
                    <div class="card-body">
                        <h5 class="card-title">Perbandingan Projek</h5>
                        <div class="chart-container">
                            <div class="chart-inner"> <!-- Tambahkan container inner untuk diagram -->
                                <canvas id="doughnutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bar Chart
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: @json($projekBerlangsung->pluck('judul')),
                datasets: [{
                    label: 'Persentase Projek',
                    data: @json($projekBerlangsung->pluck('persen')),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Doughnut Chart
        var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        var doughnutChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Sedang Dikerjakan', 'Selesai', 'Dibatalkan'],
                datasets: [{
                    label: 'Jumlah Projek',
                    data: [{{ $sedangDikerjakan }}, {{ $selesai }}, {{ $dibatalkan }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom', // Letakkan legenda di bagian bawah
                    },
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0,
                    },
                },
            }
        });
    </script>
</body>
@endsection
