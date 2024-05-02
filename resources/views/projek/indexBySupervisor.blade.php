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
                                            <td class="text-center">{{$item->persen }}%</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('projek.batalProjek', $item->id) }}" method="GET">
                                                    <button type="submit" class="btn btn-sm btn-danger">BATALKAN</button>
                                                </form>
                                            </td>
                                            </tr>
                                            @empty
                                            <div class="alert alert-danger">
                                                Data projek belum tersedia
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