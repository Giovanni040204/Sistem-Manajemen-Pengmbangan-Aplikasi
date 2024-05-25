@extends('dashboardTim')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Evaluasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Tim</a></li>
                    <li class="breadcrumb-item active">Evaluasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Judul</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $evaluasi->parentProjek->judul }}" disabled>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Deskripsi</label>
                                    <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ $evaluasi->parentProjek->deskripsi }}" disabled>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Isi Evaluasi</label>
                                    <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" rows="10" disabled>{{ $evaluasi->isi }}</textarea>
                                    @error('isi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('projek.historyTim', $id) }}" class="btn btn-warning btn-sm" style="font-size : 18px;">KEMBALI</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
