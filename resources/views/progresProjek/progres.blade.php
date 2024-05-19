@extends('dashboardSupervisor')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart with Date</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
</head>
<body>
        <div class="card">
            <div class="card-body">
                <canvas id="myChart"></canvas>
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
                            text: 'Progres Projek ({{$projek->judul}})'
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
</body>
</html>
@endsection
