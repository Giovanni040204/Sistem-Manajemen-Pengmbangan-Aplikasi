@extends('dashboardTim')

@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Line Chart with Date</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
        <style>
            .scrollable-content {
                max-height: 80vh; /* Adjust as needed */
                overflow-y: auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Progres Projek</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Progres</a>
                            </li>
                            <li class="breadcrumb-item active">Index</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4 scrollable-content">
            <div class="card mb-4">
                <div class="card-body">
                    <form>
                        <h3 class="text-center">Detail Projek</h3>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-project-diagram"></i> Judul Projek
                                </label>
                                <p>{{$projek->judul}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-align-left"></i> Deskripsi Projek
                                </label>
                                <p>{{$projek->deskripsi}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-user-tie"></i> Supervisor
                                </label>
                                <p>{{$projek->parentSupervisor->nama}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-users"></i> Tim
                                </label>
                                <p>{{$projek->parentTim->nama}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-user"></i> Client
                                </label>
                                <p>{{$projek->parentClient->nama}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-tasks"></i> Status
                                </label>
                                <p>{{$projek->status}}</p>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="font-weight-bold">
                                    <i class="fas fa-percentage"></i> Persentase Projek
                                </label>
                                <p>{{$projek->persen}}%</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Aktivitas Projek</h3>
                    <div>
                        @forelse ($aktivitas as $item)
                            <div class="activity-item mb-2">
                                <span class="activity-point">•</span>
                                <span class="activity-text">[{{ $item->tanggal }}] {{ $item->isi }}</span>
                            </div>
                        @empty
                            <div class="alert alert-danger text-center">
                                Data Projek Tidak Tersedia
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>       
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('myChart').getContext('2d');
                const data = @json($data);
                console.log(data); // Debugging to ensure data is received correctly

                // Ensure dates are formatted correctly
                const labels = data.map(item => item.tanggal);
                const values = data.map(item => item.persen);

                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Persen',
                            data: values,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: `Progres Projek Dalam Grafik`
                            }
                        },
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day'
                                },
                                title: {
                                    display: true,
                                    text: 'Tanggal',
                                    font: {
                                        weight: 'bold', // Only making the title bold
                                        size: 14 // Optionally adjust size here
                                    }
                                }
                            },
                            y: {
                                min: 0, // Minimum value for Y-axis
                                max: 100, // Maximum value for Y-axis
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Progres Persentase (%)',
                                    font: {
                                        weight: 'bold', // Only making the title bold
                                        size: 14 // Optionally adjust size here
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
        <style>
            .activity-item {
                display: flex;
                align-items: flex-start;
                margin-bottom: 10px;
            }
            .activity-point {
                margin-right: 10px;
                font-weight: bold;
            }
            .activity-text {
                font-size: 14px;
                color: #333;
                text-align: left;
            }
        </style>
    </body>
@endsection
