@extends('dashboard')

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Projek</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Projek</a>
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
                            <form action="{{ url('projek/update', $projek->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Judul Projek</label>
                                        <input readonly type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ $projek->judul }}" placeholder="Masukkan Judul Projek">
                                        @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Deskripsi Projek</label>
                                        <input readonly type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ $projek->deskripsi }}" placeholder="Masukkan Deskripsi Projek">
                                        @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Tahap Projek</label>
                                        <select class="form-control  @error('status') is-invalid @enderror" name="status" id="status" value="{{ $projek->status }}">
                                            @foreach ($status as $item)
                                            <?php
                                                if($projek->status == $item){
                                                    ?>
                                                        <option value="{{ $item }}" selected>{{ $item}}</option>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                    <?php
                                                }
                                            ?>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Persentasi Projek (%)</label>
                                        <input type="number" class="form-control @error('persen') is-invalid @enderror" name="persen" value="{{ $projek->persen }}" placeholder="Masukkan Persentasi Projek">
                                        @error('persen')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                <a href="{{ route('projek.index') }}" class="btn btn-sm btn-warning" style="font-size : 18px;">CANCEL</a>
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
