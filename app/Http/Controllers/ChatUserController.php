<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserRoom;

class ChatUserController extends Controller
{
    private $chatkit;
    private $roomId;

    public function __construct()
    {
        $this->chatkit = app('ChatKit');
        $this->roomId = env('CHATKIT_GENERAL_ROOM_ID');
    }

    public function friendhomepage(Request $request)
    {
        //chua check room va id luc rong
        $id_join = $request->idjoin;
        $get_RoomName = $request->roomnamecreate;

        $listFriends = User::all();
        $userGiDo = User::where('id', '=', Auth::id())->get();

        foreach ($userGiDo as $key => $value) {
            $id_pusher = $value['id_pusher'];
        }

        // set room động
        $this->room_Id = '5cd5623b-be0a-4587-bd20-257dcbfaeb5f';

        $room_Id = $this->room_Id;

        $fetchMessages = $this->chatkit->getRoomMessages([
            'room_id' => $room_Id,
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

        $request->session()->put('room_id', $room_Id);

        return view('app')->with(compact('id_pusher', 'room_Id', 'messages', 'listFriends'));
    }

    public function createRoom($friendID)
    {
        $id_pusher = $friendID;
        $curentPusherID = User::find(Auth::id())->id_pusher;
        $roomName = $curentPusherID.'_'.$id_pusher;
        // $query = UserRoom::

        $create = $this->chatkit->createRoom([
            'creator_id' => $curentPusherID,
            'name' => $roomName,
            'user_ids' => [$id_pusher],
            'private' => true,
            'custom_data' => ['foo' => 'bar']
        ]);

        $curentRoom = $create['body']['id'];
        // dd($create);

        $this->room_Id = $curentRoom;
        $listFriends = User::all();

        $room_Id = $this->room_Id;

        $fetchMessages = $this->chatkit->getRoomMessages([
            'room_id' => $room_Id,
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



        return view('app')->with(compact('id_pusher', 'messages', 'room_Id', 'listFriends'));
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

    /**
     * Get all users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function getUsers()
    {
        $users = $this->chatkit->getUsers();

        return response($users);
    }
}
