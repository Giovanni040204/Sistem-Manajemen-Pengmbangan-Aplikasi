@extends('dashboardSupervisor')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Projek</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Projek</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('projek.createProjek', $id) }}" class="btn btn-md btn-success mb-3">TAMBAH PROJEK</a>
                </div>
                <div class="col-sm-6">
                    <ol class="float-sm-right">
                        <form action="{{ route('projek.indexbyidSupervisor', $id) }}" class="form-inline" method="GET">
                            <input type="search" name="search" class="form-control float-right" placeholder="Masukan Judul Projek">
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
                                            <th class="text-center">Judul Projek</th>
                                            <th class="text-center">Deskripsi Projek</th>
                                            <th class="text-center">Status Projek</th>
                                            <th class="text-center">Presentasi Projek</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($projek as $item)
                                        <tr>
                                            <td class="text-center">{{$item->judul }}</td>
                                            <td class="text-center">{{$item->deskripsi }}</td>
                                            <td class="text-center">{{$item->status }}</td>
                                        <?php 
                                            if($item->persen == -1){
                                        ?>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                        <?php
                                            }else{ 
                                        ?>
                                            <td class="text-center">{{$item->persen }}%</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('projek.batalProjek', $item->id) }}" method="GET">
                                                    <a href="{{ route('progres.indexSupervisor', [$id, $item->id]) }}" class="btn btn-sm btn-primary">DETAIL</a>
                                                    <button type="submit" class="btn btn-sm btn-danger">BATALKAN</button>
                                                </form>
                                            </td>
                                        <?php 
                                            }
                                        ?>
                                        </tr>
                                            @empty
                                            <div class="alert alert-danger">
                                                Data Projek Tidak Tersedia
                                            </div>
                                            @endforelse
                                        </tbody>
                                    </table>                                 
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    @endsection