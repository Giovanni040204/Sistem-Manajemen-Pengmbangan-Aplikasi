@extends('dashboardClient')

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Evaluasi Client</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Client</a>
                        </li>
                        <li class="breadcrumb-item active">Evaluasi</li>
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
                            <form action="{{ route('evaluasi.store', [$id, $projek->id]) }}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Judul</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $projek->judul }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Deskripsi</label>
                                        <input type="text" class="form-control @error('deksripsi') is-invalid @enderror" name="deskripsi" value="{{ $projek->deskripsi }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Isi Evaluasi</label>
                                        <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" placeholder="Masukkan Evaluasi......" rows="10">{{ old('isi') }}</textarea>
                                        @error('isi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>

                                    <a href="{{ route('projek.historyClient', $id) }}" class="btn btn-sm btn-warning" style="font-size : 18px;">CANCEL</a>
                                </div>
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
