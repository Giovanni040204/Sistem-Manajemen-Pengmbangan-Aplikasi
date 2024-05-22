@extends('dashboardSupervisor')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Client</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Client</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <a href="{{ route('client.createClient', $id) }}" class="btn btn-md btn-success">Tambah Client</a>
                </div>
                <div class="col-sm-6">
                    <form action="{{ route('client.indexClient', $id) }}" class="form-inline float-sm-right" method="GET">
                        <input type="search" name="search" class="form-control" placeholder="Masukan Nama Client">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nama Client</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($client as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->nama }}</td>
                                            <td class="text-center">{{ $item->email }}</td>
                                            <td class="text-center">{{ $item->username }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('client.editClient', [$item->id,  $id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $item->id }}">Hapus</button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center alert alert-danger">
                                                Data Client Tidak Tersedia
                                            </td>
                                        </tr>
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

    <!-- Modal Konfirmasi Penghapusan -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus client ini?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Mengatur Aksi pada Modal -->
    <script>
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button yang memicu modal
            var id = button.data('id'); // Ambil data-id dari button
            var action = '{{ route('client.destroyClient', [$id, ':id']) }}'.replace(':id', id);
            $('#deleteForm').attr('action', action);
        });
    </script>
@endsection
