@extends('dashboardSupervisor')

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Jadwal</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Jadwal</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <form action="{{ route('jadwal.updateJadwalBySupervisor', [$jadwal->id, $id]) }}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Judul Projek</label>
                                        <select class="form-control  @error('id_projek') is-invalid @enderror" name="id_projek" value="{{ $jadwal->id_projek }}">
                                            @foreach ($projek as $item)
                                            <?php
                                                if($jadwal->id_projek == $item->id){
                                                    ?>
                                                        <option value="{{ $item->id }}" selected>{{ $item->judul}}</option>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <option value="{{ $item->id }}">{{ $item->judul}}</option>
                                                    <?php
                                                }
                                            ?>  
                                            @endforeach
                                        </select>
                                        @error('id_projek')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Hari</label>
                                        <select class="form-control  @error('hari') is-invalid @enderror" name="hari" value="{{ $jadwal->id_projek }}">
                                            @foreach ($hari as $item)
                                            <?php
                                                if($jadwal->hari == $item){
                                                    ?>
                                                        <option value="{{ $item }}" selected>{{ $item}}</option>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <option value="{{ $item }}">{{ $item}}</option>
                                                    <?php
                                                }
                                            ?>  
                                            @endforeach
                                        </select>
                                        @error('hari')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Waktu Mulai</label>
                                        <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" name="waktu_mulai" value="{{ $jadwal->waktu_mulai }}" placeholder="Masukan Waktu">
                                            @error('waktu_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Waktu Selesai</label>
                                        <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" name="waktu_selesai" value="{{ $jadwal->waktu_selesai }}" placeholder="Masukan Waktu">
                                            @error('waktu_selesai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                <a href="{{ route('jadwal.indexSupervisor', $id) }}" class="btn btn-sm btn-warning" style="font-size : 18px;">CANCEL</a>
                            </form>
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