@extends('dashboardTim')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">History Projek Selesai</h1>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul Projek</th>
                                            <th class="text-center">Deskripsi Projek</th>
                                            <th class="text-center">Nama Supervisor</th>
                                            <th class="text-center">Nama Tim</th>
                                            <th class="text-center">Nama Client</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($projek as $item)
                                        <tr>
                                            <td class="text-center">{{$item->judul }}</td>
                                            <td class="text-center">{{$item->deskripsi }}</td>
                                            <td class="text-center">{{$item->parentSupervisor->nama }}</td>
                                            <td class="text-center">{{$item->parentTim->nama }}</td>
                                            <td class="text-center">{{$item->parentClient->nama }}</td>
                                            <td class="text-center">{{$item->status }}</td>
                                        </tr>
                                            @empty
                                            <div class="alert alert-danger">
                                                Belum ada projek yang selesai
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