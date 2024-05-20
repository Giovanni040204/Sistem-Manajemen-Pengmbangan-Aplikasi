@extends('dashboardAdmin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tim</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Tim</a>
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
                <div class="col-sm-12">
                    <ol class="float-sm-right">
                        <form action="{{ route('tim.indexAdmin') }}" class="form-inline" method="GET">
                            <input type="search" name="search" class="form-control float-right" placeholder="Masukan Nama Tim">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </ol>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Tim</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tim as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->nama }}</td>
                                            <td class="text-center">{{ $item->username }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#confirmResetModal{{ $item->id }}">
                                                    RESET
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Reset Password Modal -->
                                        <div class="modal fade" id="confirmResetModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmResetModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmResetModalLabel{{ $item->id }}">Konfirmasi Reset Password</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin mereset password tim ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <form action="{{ route('tim.resetPasswordTim', $item->id) }}" method="GET" class="d-inline">
                                                            <button type="submit" class="btn btn-warning">Reset</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Tim Tidak Tersedia
                                        </div>
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
