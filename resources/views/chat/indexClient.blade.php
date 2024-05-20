@extends('dashboardClient')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Chat Client</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Chat</a></li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="chat-container">
                    <div class="chat-header">
                        Chat
                    </div>
                    <div class="chat-messages">
                        @php $cek = -1; @endphp
                        @forelse ($chat as $item)
                            @if($item->status == 'Client')
                                @if($cek == -1 || $cek == 1)
                                    <div class="chat-message client">
                                        <div><strong>{{ $item->parentClient->nama }}</strong></div>
                                        <div class="message-content">{{ $item->isi }}</div>
                                    </div>
                                @else
                                    <div class="chat-message client">
                                        <div class="message-content">{{ $item->isi }}</div>
                                    </div>
                                @endif
                                @php $cek = 0; @endphp
                            @elseif($item->status == 'Tim')
                                @if($cek == -1 || $cek == 0)
                                    <div class="chat-message tim">
                                        <div><strong>{{ $item->parentTim->nama }}</strong></div>
                                        <div class="message-content">{{ $item->isi }}</div>
                                    </div>
                                @else
                                    <div class="chat-message tim">
                                        <div class="message-content">{{ $item->isi }}</div>
                                    </div>
                                @endif
                                @php $cek = 1; @endphp
                            @endif
                        @empty
                        <div class="alert alert-danger">
                            Belum Ada Obrolan
                        </div>
                        @endforelse
                    </div>
                    <div class="chat-input">
                        <form action="{{ route('chat.storeClient', [$idc, $idt, $idp]) }}" method="GET" class="w-100 d-flex">
                            <input type="text" class="form-control @error('isi') is-invalid @enderror" name="isi" value="{{ old('isi') }}" placeholder="Masukan Pesan .......">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-send"></i> Kirim
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>

<style>
    .chat-container {
        display: flex;
        flex-direction: column;
        height: 100vh;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
    }
    .chat-header {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .chat-message {
        margin-bottom: 15px;
    }
    .chat-message.client {
        text-align: right;
    }
    .chat-message.client .message-content {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    .chat-message.tim {
        text-align: left;
    }
    .chat-message.tim .message-content {
        background-color: #c3e6cb;
        color: #155724;
    }
    .message-content {
        display: inline-block;
        padding: 10px;
        border-radius: 10px;
    }
    .chat-input {
        display: flex;
        margin-top: 20px;
    }
    .chat-input input {
        flex: 1;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .chat-input button {
        padding: 10px 20px;
        margin-left: 10px;
        border-radius: 5px;
        border: none;
        background-color: #007bff;
        color: white;
    }
</style>

@endsection
