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
                                            <th class="text-center">Deskripsi Projek</th>
                                            <th class="text-center">Status Projek</th>
                                            <th class="text-center">Presentasi Projek</th>
                                            <th class="text-center">Tanggal Mulai</th>
                                            <th class="text-center">Tanggal Selesai</th>
                                            <th class="text-center">Aksi</th>
                                            <th class="text-center">Obrolan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($projek as $item)
                                        <tr>
                                            <td class="text-center">{{$item->judul }}</td>
                                            <td class="text-center">{{$item->deskripsi }}</td>
                                            <td class="text-center">{{$item->status }}</td>
                                            @if($item->persen == -1)
                                                <td class="text-center">-</td>
                                                <td class="text-center">{{$item->tanggal_mulai }}</td>
                                                <td class="text-center">{{$item->tanggal_selesai }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-danger" onclick="confirmProjek('{{ route('projek.konfirmasiProjek', [$id, $item->id]) }}')">KONFIRMASI</button>
                                                </td>
                                                <td class="text-center">-</td>
                                            @else
                                                <td class="text-center">{{$item->persen }}%</td>
                                                <td class="text-center">{{$item->tanggal_mulai }}</td>
                                                <td class="text-center">{{$item->tanggal_selesai }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('projek.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    <a href="{{ route('progres.indexTim', [$id, $item->id]) }}" class="btn btn-sm btn-primary">DETAIL</a>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteProjek('{{ route('projek.destroy', $item->id) }}')">HAPUS</button>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('chat.indexTim', [$item->parentClient->id, $item->parentTim->id, $item->id] )}}" class="btn btn-sm btn-primary">Pesan</a>
                                                </td>
                                            @endif
                                        </tr>
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

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmProjek(url) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Projek ini akan dikonfirmasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, konfirmasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }

        function deleteProjek(url) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Projek ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var inputCsrf = document.createElement('input');
                    inputCsrf.type = 'hidden';
                    inputCsrf.name = '_token';
                    inputCsrf.value = csrfToken;
                    form.appendChild(inputCsrf);
                    var inputMethod = document.createElement('input');
                    inputMethod.type = 'hidden';
                    inputMethod.name = '_method';
                    inputMethod.value = 'DELETE';
                    form.appendChild(inputMethod);
                    document.body.appendChild(form);
                    form.submit();
                }
            })
        }
    </script>
@endsection
