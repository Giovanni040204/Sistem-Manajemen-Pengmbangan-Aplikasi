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
                        <a href="#">Projek</a>
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
                        ?>
                            <div class="form-text" style="text-align: right;"><b>{{$item->parentClient->nama}}</b></div>
                            <div class="form-text" style="text-align: right;">{{$item->isi}}</div>
                        <?php
                            }else if($item->status == 'Tim'){
                        ?>
                            <div class="form-text"><b>{{$item->parentTim->nama}}</b></div>
                            <div class="form-text">{{$item->isi}}</div>
                        <?php
                            }
                        ?>
                    </div>
                </form>
                <hr size="10px">
                @endforeach 
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