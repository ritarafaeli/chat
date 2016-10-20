<?php

namespace App\Http\Controllers;
use Auth;

use App\Message;
use Illuminate\Http\Request;

use App\Http\Requests;

class MessageController extends Controller
{
    public function create(Request $request, $id){
        $user = Auth::user();
        $this->validate($request, [
            'message' => 'required|max:1000'
        ]);
        $message = new Message();
        $message->setAttribute('chat_id', $id);
        $message->setAttribute('payload', $request->get('message'));
        $message->setAttribute('isFromRep', $user !== null );

        $message->save();
    }
}