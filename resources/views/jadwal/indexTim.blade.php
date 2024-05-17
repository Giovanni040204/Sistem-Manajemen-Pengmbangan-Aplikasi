@extends('dashboardTim')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Jadwal</a>
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
                {{-- <div class="col-sm-6">
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
                </div> --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul Projek</th>
                                            <th class="text-center">Topik Yang Dibahas</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Waktu</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($jadwal as $item)
                                        <tr>
                                            <td class="text-center">{{$item->parentProjek->judul }}</td>
                                            <td class="text-center">{{$item->topik }}</td>
                                            <td class="text-center">{{$item->lokasi }}</td>
                                            <td class="text-center">{{$item->tanggal }}</td>
                                            <td class="text-center">{{$item->waktu }}</td>
                                            <?php
                                                if($item->status == 'Belum Disetujui'){
                                            ?>
                                                <td class="text-center">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('jadwal.updateJadwalByTim', [$item->id,  $id]) }}" method="GET">
                                                        <button type="submit" class="btn btn-sm btn-danger">KONFIRMASI</button>
                                                    </form>
                                                </td>
                                            <?php
                                                }else{
                                            ?>
                                                <td class="text-center">Disetujui</td>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Jadwal Tidak Tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>                                 
                            </div>
                        </div>
                    </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    @endsection