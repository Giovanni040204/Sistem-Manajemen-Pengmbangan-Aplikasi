@extends('dashboardTim')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Jadwal</a>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Judul Projek</th>
                                            <th class="text-center">Topik Yang Dibahas</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Waktu</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($jadwal as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->parentProjek->judul }}</td>
                                            <td class="text-center">{{ $item->topik }}</td>
                                            <td class="text-center">{{ $item->lokasi }}</td>
                                            <td class="text-center">{{ $item->tanggal }}</td>
                                            <td class="text-center">{{ $item->waktu }}</td>
                                            @if($item->status == 'Belum Disetujui')
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmUpdateModal" data-id="{{ $item->id }}">Konfirmasi</button>
                                                </td>
                                            @else
                                                <td class="text-center">Disetujui</td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center alert alert-danger">
                                                Data Jadwal Tidak Tersedia
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
    <div class="modal fade" id="confirmUpdateModal" tabindex="-1" role="dialog" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUpdateModalLabel">Konfirmasi Perubahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengkonfirmasi jadwal ini?
                </div>
                <div class="modal-footer">
                    <form id="updateForm" action="" method="GET">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Mengatur Aksi pada Modal -->
    <script>
        $('#confirmUpdateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button yang memicu modal
            var id = button.data('id'); // Ambil data-id dari button
            var action = '{{ route('jadwal.updateJadwalByTim', [$id, ':id']) }}'.replace(':id', id);
            $('#updateForm').attr('action', action);
        });
    </script>
@endsection
