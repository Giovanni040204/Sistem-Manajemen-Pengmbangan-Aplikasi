<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function indexClient($idc, $idt){
        $chat = Chat::where('id_client','=',$idc)->where('id_client','=',$idt)->get();
        $id = $idc;

        return view('chat.indexClient', compact('chat','id'));
    }
}
