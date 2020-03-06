<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomChat;
use DB;
use Illuminate\Support\Facades\Auth;

class ChatkitController extends Controller
{
    //
    private $chatkit;
    private $roomId;

    public function __construct()
    {
        $this->chatkit = app('ChatKit');
        $this->roomId = env('CHATKIT_GENERAL_ROOM_ID');
    }

    /**
     * Show the application chat room.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function chat(Request $request)
    {
        $chatkit_id = Auth::user()->id_pusher;
        $listRoom = RoomChat::all();

        $query = DB::select("select count(id) as NumberOfRoom from room_chats");

        if ((int)$request->roomid > $query[0]->NumberOfRoom){
            $this->roomId = RoomChat::where('id', '=', 1)->first()->id_room;
            $roomName = 1;
        }else if ((int)$request->roomid <= $query[0]->NumberOfRoom){
            $this->roomId = RoomChat::where('id', '=', $request->roomid)->first()->id_room;
            $roomName = $request->roomid;
        }

        $roomId = $this->roomId;

        $request->session()->put('room_id', $roomId);

        $this->chatkit->addUsersToRoom([
            'room_id' => $this->roomId,
            'user_ids' => [$chatkit_id],
        ]);

        $fetchMessages = $this->chatkit->getRoomMessages([
            'room_id' => $roomId,
            'direction' => 'newer',
            'limit' => 100
        ]);

        $messages = collect($fetchMessages['body'])->map(function ($message) {
            return [
                'id' => $message['id'],
                'senderId' => $message['user_id'],
                'text' => $message['text'],
                'timestamp' => $message['created_at'],
            ];
        });

        return view('chat')->with(compact('messages', 'roomId', 'chatkit_id', 'listRoom', 'roomName'));
    }

    /**
     * Receives a client request and provides a new token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function authenticate(Request $request)
    {
        $response = $this->chatkit->authenticate([
            'user_id' => $request->user_id,
        ]);

        return response()
            ->json(
                $response['body'],
                $response['status']
            );
    }

     /**
     * Send user message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function sendMessage(Request $request)
    {
        $roomId = $request->session()->get('room_id');

        $message = $this->chatkit->sendSimpleMessage([
            'sender_id' => $request->user,
            'room_id' => $roomId,
            'text' => $request->message
        ]);

        return response($message);
    }

    public function createRoom(Request $request)
    {
        $roomChat = new RoomChat;
        $roomName = $request->roomname;
        $create = $this->chatkit->createRoom([
            'creator_id' => Auth::user()->id_pusher,
            'name' => $roomName,
            'user_ids' => [Auth::user()->id_pusher],
            'private' => false,
            'custom_data' => ['foo' => 'bar']
        ]);

        $roomChat->id_room = $create['body']['id'];
        $roomChat->save();

        return redirect('/gr/chat/1');
    }

    /**
     * Get all users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function getUsers()
    {
        $opt['limit'] = 100;
        $users = $this->chatkit->getUsers($opt);

        return response($users);
    }

    /**
     * Get all users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect(route('login'));
    }
}
