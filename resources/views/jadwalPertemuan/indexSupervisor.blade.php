@extends('dashboardSupervisor')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Pertemuan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Jadwal Pertemuan</a>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        @forelse ($jadwalPertemuan as $item)
                                        <tr>
                                            <?php
                                            if($ganti == 0){
                                                ?>
                                                <td class="text-center"><b>Senin</b><br>{{$tanggal[0]}}</td>
                                                <?php
                                            }
                                            ?>
                                            @forelse ($jadwalPertemuan as $item)
                                            <?php
                                            if($item->hari == 'Senin' && $ganti==0){
                                                ?>
                                                <td class="text-center">
                                                    {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                                    <br>{{$item->parentProjek->judul}}
                                                </td>
                                                <?php
                                                $cek++;
                                            }
                                            ?>
                                            @empty
                                            @endforelse
                                            <?php
                                            for($i=$cek;$i<$banyak && $ganti==0;$i++){
                                                ?>
                                                <td class="text-center">-</td>
                                                <?php
                                            }
                                            $cek = 0;
                                            $ganti++;
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if($ganti == 1){
                                                ?>
                                                <td class="text-center"><b>Selasa</b><br>{{$tanggal[1]}}</td>
                                                <?php
                                            }
                                            ?>
                                            @forelse ($jadwalPertemuan as $item)
                                            <?php
                                            if($item->hari == 'Selasa' && $ganti==1){
                                                ?>
                                                <td class="text-center">
                                                    {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                                    <br>{{$item->parentProjek->judul}}
                                                </td>
                                                <?php
                                                $cek++;
                                            }
                                            ?>
                                            @empty
                                            @endforelse
                                            <?php
                                            for($i=$cek;$i<$banyak && $ganti==1;$i++){
                                                ?>
                                                <td class="text-center">-</td>
                                                <?php
                                            }
                                            $cek = 0;
                                            $ganti++;
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if($ganti == 2){
                                                ?>
                                                <td class="text-center"><b>Rabu</b><br>{{$tanggal[2]}}</td>
                                                <?php
                                            }
                                            ?>
                                            @forelse ($jadwalPertemuan as $item)
                                            <?php
                                            if($item->hari == 'Rabu' && $ganti==2){
                                                ?>
                                                <td class="text-center">
                                                    {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                                    <br>{{$item->parentProjek->judul}}
                                                </td>
                                                <?php
                                                $cek++;
                                            }
                                            ?>
                                            @empty
                                            @endforelse
                                            <?php
                                            for($i=$cek;$i<$banyak && $ganti==2;$i++){
                                                ?>
                                                <td class="text-center">-</td>
                                                <?php
                                            }
                                            $cek = 0;
                                            $ganti++;
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if($ganti == 3){
                                                ?>
                                                <td class="text-center"><b>Kamis</b><br>{{$tanggal[3]}}</td>
                                                <?php
                                            }
                                            ?>
                                            @forelse ($jadwalPertemuan as $item)
                                            <?php
                                            if($item->hari == 'Kamis' && $ganti==3){
                                                ?>
                                                <td class="text-center">
                                                    {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                                    <br>{{$item->parentProjek->judul}}
                                                </td>
                                                <?php
                                                $cek++;
                                            }
                                            ?>
                                            @empty
                                            @endforelse
                                            <?php
                                            for($i=$cek;$i<$banyak && $ganti==3;$i++){
                                                ?>
                                                <td class="text-center">-</td>
                                                <?php
                                            }
                                            $cek = 0;
                                            $ganti++;
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if($ganti == 4){
                                                ?>
                                                <td class="text-center"><b>Jumat</b><br>{{$tanggal[4]}}</td>
                                                <?php
                                            }
                                            ?>
                                            @forelse ($jadwalPertemuan as $item)
                                            <?php
                                            if($item->hari == 'Jumat' && $ganti==4){
                                                ?>
                                                <td class="text-center">
                                                    {{$item->waktu_mulai}} - {{$item->waktu_selesai}}
                                                    <br>{{$item->parentProjek->judul}}
                                                </td>
                                                <?php
                                                $cek++;
                                            }
                                            ?>
                                            @empty
                                            @endforelse
                                            <?php
                                            for($i=$cek;$i<$banyak && $ganti==4;$i++){
                                                ?>
                                                <td class="text-center">-</td>
                                                <?php
                                            }
                                            $cek = 0;
                                            $ganti++;
                                            ?>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Jadwal Pertemuan Belum Tersedia
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