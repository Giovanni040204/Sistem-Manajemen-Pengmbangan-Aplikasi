@extends('dashboardClient')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Chat Client</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Chat</a>
                    </li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">

        </div>
    </div> 
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @foreach ($chat as $item)
                <form>
                    <div class="mb-3">
                        <?php 
                            if($item->status == 'Client'){
                                if($cek == -1 || $cek==1){
                        ?>
                                    <div class="form-text" style="text-align: right;"><b>{{$item->parentClient->nama}}</b></div>
                        <?php
                                }
                        ?>
                                <div class="form-text" style="text-align: right;">{{$item->isi}}</div>
                        <?php
                                $cek = 0;
                            }else if($item->status == 'Tim'){
                                if($cek == -1 || $cek==0){
                        ?>
                                    <div class="form-text"><b>{{$item->parentTim->nama}}</b></div>
                        <?php
                                }
                        ?>                            
                                <div class="form-text">{{$item->isi}}</div>
                        <?php
                                $cek = 1;
                            }
                        ?>
                    </div>
                </form>
                <hr size="10px">
                @endforeach 
                <div class="col-sm-12">
                    <ol class="float-sm-right">
                        <form action="{{ route('chat.storeClient', [$idc, $idt, $idp]) }}" class="form-inline" method="GET">
                            <input type="isi" name="isi" class="form-control" placeholder="Masukan Pesan .......">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-send"></i>
                                </button>
                            </div>
                        </form>
                    </ol>
                </div>
                {{-- <div class="r-chat-box y-black-text r-chat-boxtype2 y-blue-bg y-white-text">
                
                </div>  --}}
                {{-- @empty
                <div class="alert alert-danger">
                    Data projek belum tersedia
                </div> --}}
                         
            </div>
        </div>
    </div>      
</div>
@endsection