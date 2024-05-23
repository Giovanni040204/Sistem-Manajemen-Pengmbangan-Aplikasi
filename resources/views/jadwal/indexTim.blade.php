@extends('dashboardTim')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Jadwal</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul Projek</th>
                                            <th class="text-center">Hari</th>
                                            <th class="text-center">Waktu Mulai</th>
                                            <th class="text-center">Waktu Selesai</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($jadwal as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->parentProjek->judul }}</td>
                                            <td class="text-center">{{ $item->hari }}</td>
                                            <td class="text-center">{{ $item->waktu_mulai }}</td>
                                            <td class="text-center">{{ $item->waktu_selesai }}</td>
                                            @if($item->status == 'Belum Disetujui')
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmUpdateModal{{ $item->id }}">Konfirmasi</button>
                                                </td>
                                            @else
                                                <td class="text-center">Disetujui</td>
                                            @endif
                                        </tr>

                                        <!-- Modal Konfirmasi Penghapusan -->
                                        <div class="modal fade" id="confirmUpdateModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmUpdateModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmUpdateModalLabel{{ $item->id }}">Konfirmasi Perubahan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin mengkonfirmasi jadwal ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <form action="{{ route('jadwal.updateJadwalByTim', [$item->id, $id]) }}" method="GET" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Konfirmasi</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center alert alert-danger">
                                                Data Jadwal Tidak Tersedia
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .modal-content {
            border-radius: 10px;
        }
        .modal-header {
            background-color: #f8d7da;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        
        .modal-footer {
            border-top: none;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
@endsection
