<?php

namespace App\Http\Controllers;
use Auth;

use App\Message;
use App\Chat;
use Illuminate\Http\Request;

use App\Http\Requests;

use Maatwebsite\Excel\Facades\Excel;

class ChatController extends Controller
{
    public function create(Request $request){
        $chat = new Chat();
        $chat->setAttribute('visitor_name',  $request->get('name'));
        $chat->setAttribute('visitor_email',  $request->get('email'));
        $chat->save();
        return view('welcome');
    }
    public function unassigned(Request $request){
        $chats = DB::table('chats')
            ->select('chats.*')
            ->where('representative_id',nullValue())
            ->get();
        return view('unassigned')->with('chats', $chats);
    }
    public function inbox(Request $request){
        $user = Auth::user();
        $chats = DB::table('chats')
            ->select('chats.*')
            ->where('representative_id',$user->id)
            ->get();
        return view('inbox')->with('chats', $chats);
    }
    public function getChat($id){
        $messages = DB::table('messages')
            ->select('messages.*')
            ->where('chat_id',$id)
            ->toArray();
        return view('welcome')->with('messages', $messages);
    }
    public function downloadTranscript($id){
        $messages = DB::table('messages')
            ->select('messages.*')
            ->where('chat_id',$id)
            ->toArray();

        Excel::create('ChatTranscript', function($excel) use($messages) {
            // Set the title
            $excel->setTitle('Chat Transcript');
            $excel->setDescription('Chat Transcript with Representative');
            $excel->sheet('Chat', function($sheet) use($messages) {
                $sheet->fromArray($messages);
            });
        })->download('csv');

        return view('welcome');
    }
    public function assign(Request $request, $id){
        $user = Auth::user();
        $chat = Chat::find($id)->get();
        $chat->setAttribute('representative_id', $user->id);
        $this->inbox($request);
    }

}