<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomChat;
use App\User;
use Illuminate\Support\Facades\DB;
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
        $listRooms = RoomChat::all();
        $listFriends = User::all();

        $query = DB::select("select count(id) as NumberOfRoom from room_chats");

        if ((int)$request->roomid > $query[0]->NumberOfRoom){
            $this->roomId = RoomChat::where('id', '=', 1)->first()->id_room;
            $roomName = "Room 1";
            $imgRoom = RoomChat::where('id', 1)->first()->avatar_room;
        }else if ((int)$request->roomid <= $query[0]->NumberOfRoom){
            $this->roomId = RoomChat::where('id', '=', $request->roomid)->first()->id_room;
            $roomName = RoomChat::where('id', $request->roomid)->first()->room_name;
            $imgRoom = RoomChat::where('id', $request->roomid)->first()->avatar_room;
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
            if (isset( $message['attachment']['resource_link'])){
                return [
                    'id' => $message['id'],
                    'senderId' => $message['user_id'],
                    'text' => $message['text'],
                    'timestamp' => $message['created_at'],
                    'image' =>  $message['attachment']['resource_link'],
                ];
            }
            return [
                'id' => $message['id'],
                'senderId' => $message['user_id'],
                'text' => $message['text'],
                'timestamp' => $message['created_at'],
            ];
        });

        return view('box-chat-group')->with(compact('messages', 'roomId', 'chatkit_id', 'listFriends', 'listRooms', 'roomName', 'imgRoom'));
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

        $roomChat->room_name = $roomName;
        $roomChat->id_room = $create['body']['id'];
        $roomChat->avatar_room = "https://i.picsum.photos/id/".rand(500, 999)."/200/200.jpg";
        // $roomChat->avatar_room = $imgRoom;
        $roomChat->id_user_create_room = Auth::user()->id_pusher;
        $roomChat->save();

        return redirect('/group/1');
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
}
