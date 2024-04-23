@extends('dashboardSupervisor')

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Password Client</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Client</a>
                        </li>
                        <li class="breadcrumb-item active">Password</li>
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
                            <form action="{{ route('client.ubahPassword', $id) }}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Masukan Password Sebelumnya</label>
                                        <input type="password" class="form-control @error('lama') is-invalid @enderror" name="lama" value="{{ old('lama') }}" placeholder="Masukkan Password Sebelumnya">
                                        @error('lama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Masukan Password Baru</label>
                                        <input type="password" class="form-control @error('baru') is-invalid @enderror" name="baru" value="{{ old('baru') }}" placeholder="Masukkan Password Baru">
                                        @error('baru')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Konfirmasi Ulang Password Baru</label>
                                        <input type="password" class="form-control @error('konfirmasi') is-invalid @enderror" name="konfirmasi" value="{{ old('konfirmasi') }}" placeholder="Konfirmasi Ulang Password Baru">
                                        @error('konfirmasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">UBAH</button>

                                <a href="{{ route('projek.indexbyidClient', $id) }}" class="btn btn-sm btn-warning" style="font-size : 18px;">CANCEL</a>
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
