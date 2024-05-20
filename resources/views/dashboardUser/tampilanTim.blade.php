@extends('dashboardTim')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS Font */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
    
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }
    
        .card {
            width: calc(33.33% - 20px);
            height: 150px;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
            position: relative;
        }
    
        .card:hover {
            transform: scale(1.05);
        }
    
        /* Font Style */
        .card h2 {
            margin-bottom: 10px;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 20px;
        }
    
        .card p {
            color: #f0f0f0;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
        }
    
        .watermark {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: rgba(255, 255, 255, 0.1);
            font-size: 50px;
            pointer-events: none;
        }
    
        /* Variasi warna background */
        .card:nth-child(odd) {
            background-color: #007bff; /* Biru */
        }
    
        .card:nth-child(even) {
            background-color: #28a745; /* Hijau */
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="card" onclick="window.location.href='{{ route('projek.indexbyidTim', $id) }}'">
            <h2>Daftar Projek</h2>
            <p>Description of Card 1</p>
            <i class="fas fa-cogs watermark"></i>
        </div>
        <div class="card" onclick="window.location.href='{{ route('jadwal.indexTim', $id) }}'">
            <h2>Daftar Jadwal</h2>
            <p>Description of Card 2</p>
            <i class="fas fa-user-tie watermark"></i>
        </div>
        <div class="card" onclick="window.location.href='{{ route('projek.historyTim', $id) }}'">
            <h2>History Projek</h2>
            <p>Description of Card 3</p>
            <i class="fas fa-users watermark"></i>
        </div>
    </div>
</body>
@endsection
