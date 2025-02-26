@extends('dashboardSupervisor')

@section('content')
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Client</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Client</a>
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
                            <form action="{{ route('client.updateClient', [$client->id, $id] ) }}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Nama Client</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $client->nama }}" placeholder="Masukkan Nama Client">
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Email Client</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $client->email }}" placeholder="Masukkan Email Client">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Username Client</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $client->username }}" placeholder="Masukkan Username Client">
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group col-md-12">
                                        <label class="font-weight-bold">Password Client</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $client->password }}" placeholder="Masukkan Password Client">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> --}}
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                <a href="{{ route('client.indexClient', $id) }}" class="btn btn-sm btn-warning" style="font-size : 18px;">CANCEL</a>
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
