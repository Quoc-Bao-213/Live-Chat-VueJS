<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserRoom;
use DB;

class ChatUserController extends Controller
{
    private $chatkit;
    private $roomId;

    public function __construct()
    {
        $this->chatkit = app('ChatKit');
        $this->roomId = env('CHATKIT_GENERAL_ROOM_ID');
    }

    public function friendhomepage(Request $request, $friendID)
    {
        $id_pusher = $friendID; // id friend
        $curentPusherID = User::find(Auth::id())->id_pusher;  // id mình my_id
        $roomName = $curentPusherID.'_'.$id_pusher;

        // đoạn này check trong database xem room có chưa
        $checkRoomExist = DB::select("SELECT * FROM `user_rooms` where `my_id` = '$curentPusherID'  and `friend_id` = '$friendID'");


        if (empty($checkRoomExist)){
            // câu này để cho là bạn mình nó bấm vô mình thì cũng chỉ có chung 1 room thôi.
            $checkRoomExist = DB::select("SELECT * FROM `user_rooms` where `friend_id` = '$curentPusherID'  and `my_id` = '$friendID'");
        }

        // Nếu có room r thì ko tạo mới, ngược lại tạo room r lưu vô database
        if (!empty($checkRoomExist) && $checkRoomExist[0]->room_id){
            $curentRoom = $checkRoomExist[0]->room_id;
        }else{
            $create = $this->chatkit->createRoom([
                'creator_id' => $curentPusherID,
                'name' => $roomName,
                'user_ids' => [$id_pusher],
                'private' => true,
                'custom_data' => ['foo' => 'bar']
            ]);
            $curentRoom = $create['body']['id'];

            $addUserRoom = new UserRoom;
            $addUserRoom->my_id = $curentPusherID;
            $addUserRoom->friend_id = $id_pusher;
            $addUserRoom->room_id = $curentRoom;
            $addUserRoom->save();
        }

        $this->room_Id = $curentRoom;
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

        $listFriends = User::all();
        $friendName = User::where('id_pusher', $friendID)->first()->name;

        return view('app')->with(compact('id_pusher', 'messages', 'room_Id', 'listFriends', 'friendName'));
    }

     /**
     * Send user message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function sendMessage(Request $request)
    {
        $roomId = $request->currentRoom;
        $my_id = Auth::user()->id_pusher;

        $message = $this->chatkit->sendSimpleMessage([
            'sender_id' => $my_id,
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
