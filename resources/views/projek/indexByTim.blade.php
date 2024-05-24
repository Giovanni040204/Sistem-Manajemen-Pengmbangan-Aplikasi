@extends('dashboardTim')
@include('sweetalert::alert')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Projek</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('projek.indexbyidTim', $id) }}">Projek</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="float-sm-right">
                        <form action="{{ route('projek.indexbyidTim', $id) }}" class="form-inline" method="GET">
                            <input type="search" name="search" class="form-control float-right" placeholder="Masukan Judul Projek">
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
                                            <th class="text-center">Judul Projek</th>
                                            <th class="text-center">Status Projek</th>
                                            <th class="text-center">Presentasi Projek</th>
                                            <th class="text-center">Tanggal Selesai</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Obrolan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($projek as $item)
                                        <tr>
                                            <td class="text-center">{{$item->judul }}</td>
                                            <td class="text-center">{{$item->status }}</td>
                                            @if($item->persen == -1)
                                                <td class="text-center">-</td>
                                                <td class="text-center">{{$item->tanggal_selesai }}</td>
                                                <td class="text-center">
                                                    <!-- Tombol untuk memicu modal konfirmasi -->
                                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmProjekModal{{ $item->id }}">KONFIRMASI</button>
                                                </td>
                                                <td class="text-center">-</td>
                                            @else
                                                <td class="text-center">{{$item->persen }}%</td>
                                                <td class="text-center">{{$item->tanggal_selesai }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('projek.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    <a href="{{ route('progres.indexTim', [$id, $item->id]) }}" class="btn btn-sm btn-primary">DETAIL</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('chat.indexTim', [$item->parentClient->id, $item->parentTim->id, $item->id] )}}" class="btn btn-sm btn-primary">Pesan</a>
                                                </td>
                                            @endif
                                        </tr>
                                        <!-- Modal Konfirmasi Projek -->
                                        <div class="modal fade" id="confirmProjekModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmProjekModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmProjekModalLabel{{ $item->id }}">Konfirmasi Projek</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin mengonfirmasi projek ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <form action="{{ route('projek.konfirmasiProjek', [$id, $item->id]) }}" method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Konfirmasi</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Projek Tidak Tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
