@extends('dashboardAdmin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Client</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Client</a>
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
                <div class="col-sm-12">
                    <ol class="float-sm-right">
                        <form action="{{ route('client.indexAdmin') }}" class="form-inline" method="GET">
                            <input type="search" name="search" class="form-control float-right" placeholder="Masukan Nama Client">
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
                                            <th class="text-center">Nama Client</th>
                                            <th class="text-center">Username</th>
                                            {{-- <th class="text-center">Password</th> --}}
                                            <th class="text-center">Password</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($client as $item)
                                        <tr>
                                            <td class="text-center">{{$item->nama }}</td>
                                            <td class="text-center">{{$item->username }}</td>
                                            {{-- <td class="text-center">{{$item->password }}</td> --}}
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('client.resetPasswordClient', $item->id) }}" method="GET">
                                                    <button type="submit" class="btn btn-sm btn-warning">RESET</button>
                                                </form>
                                            </td>
                                            </tr>
                                            @empty
                                            <div class="alert alert-danger">
                                                Data Client Tidak Tersedia
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