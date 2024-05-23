@extends('dashboardSupervisor')

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
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('jadwal.createJadwal', $id) }}" class="btn btn-md btn-success mb-3">TAMBAH JADWAL</a>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Jadwal Menunggu Konfirmasi</h5>
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul Projek</th>
                                            <th class="text-center">Hari</th>
                                            <th class="text-center">Waktu Mulai</th>
                                            <th class="text-center">Waktu Selesai</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($jadwalBelumSetuju as $item)
                                        <tr>
                                            <td class="text-center">{{$item->parentProjek->judul }}</td>
                                            <td class="text-center">{{$item->hari }}</td>
                                            <td class="text-center">{{$item->waktu_mulai }}</td>
                                            <td class="text-center">{{$item->waktu_selesai }}</td>
                                            <td class="text-center">{{$item->status }}</td>
                                            <?php
                                                if($item->status == 'Belum Disetujui'){
                                            ?>
                                                <td class="text-center">
                                                    <a href="{{ route('jadwal.editJadwal', [$item->id,  $id]) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                </td>
                                            <?php
                                                }else{
                                            ?>
                                                <td class="text-center">Tidak Bisa Diedit</td>                                       
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
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Jadwal Siap Generate</h5>
                                <div class="table-responsive p-0">
                                    <div class="col-sm-12">
                                        <a href="{{ route('jadwalPertemuan.store', $id) }}" class="btn btn-md btn-success mb-3">GENERATE JADWAL</a>
                                    </div>
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Judul Projek</th>
                                                <th class="text-center">Hari</th>
                                                <th class="text-center">Waktu Mulai</th>
                                                <th class="text-center">Waktu Selesai</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($jadwalSetuju as $item)
                                            <tr>
                                                <td class="text-center">{{$item->parentProjek->judul }}</td>
                                                <td class="text-center">{{$item->hari }}</td>
                                                <td class="text-center">{{$item->waktu_mulai }}</td>
                                                <td class="text-center">{{$item->waktu_selesai }}</td>
                                                <td class="text-center">{{$item->status }}</td>
                                                <?php
                                                    if($item->status == 'Belum Disetujui'){
                                                ?>
                                                    <td class="text-center">
                                                        <a href="{{ route('jadwal.editJadwal', [$item->id,  $id]) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td class="text-center">Tidak Bisa Diedit</td>                                       
                                                <?php 
                                                    }
                                                ?>
                                                </tr>
                                                @empty
                                                <div class="alert alert-danger">
                                                    Belum Ada Jadwal Yang Siap Digenerate
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