<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserRoom;
use App\RoomChat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatUserController extends Controller
{
    private $chatkit;
    private $roomId;

    public function __construct()
    {
        $this->chatkit = app('ChatKit');
        $this->roomId = env('CHATKIT_GENERAL_ROOM_ID');
    }

    public function index()
    {
        $listFriends = User::all();
        $listRooms = RoomChat::all();

        return view('index', compact('listFriends', 'listRooms'));
    }

    public function friendhomepage(Request $request, $friendID)
    {
        $id_pusher = $friendID; // id friend
        $curentPusherID = User::find(Auth::id())->id_pusher;  // id mình my_id
        $roomName = $curentPusherID.'_'.$id_pusher;
        $listFriends = User::all();
        $listRooms = RoomChat::all();

        if (DB::select("select name from users where id_pusher = '".$id_pusher."'")){

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
                if (isset($message['attachment']['resource_link'])){
                    return [
                        'id' => $message['id'],
                        'senderId' => $message['user_id'],
                        'text' => $message['text'],
                        'timestamp' => $message['created_at'],
                        'image' =>  $message['attachment']['resource_link'],
                    ];
                }
                // dd ($message['attachment']['resource_link']);
                return [
                    'id' => $message['id'],
                    'senderId' => $message['user_id'],
                    'text' => $message['text'],
                    'timestamp' => $message['created_at'],
                ];
            });

            $avatar = User::where('id_pusher', $friendID)->first()->avatar;
            $FriendName = User::where('id_pusher', $friendID)->first()->name;

            return view('box-chat-friend')->with(compact('curentPusherID', 'listRooms', 'messages', 'room_Id', 'listFriends', 'avatar', 'FriendName'));
        }else{
            return view('index', compact('listFriends', 'listRooms'));
        }
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

        if($request->isAttachment) // true
        {
            $imageType = 'jpg';
            $base64_image = base64_decode(explode(',',$request->image)[1]);
            $nameImage = Str::random(10).".".$imageType;
            Storage::disk('mychat')->put($nameImage, $base64_image);
            $resource_link = url('/').'/uploads/'.$nameImage;

            $options['sender_id'] = $my_id;
            $options['room_id']  = $roomId;
            if (!empty($request->message)){
                $options['text']  = $request->message;
            }else{
                $options['text']  = ' ';
            }
            $options['attachment']['resource_link'] = $resource_link;
            $options['attachment']['type'] = 'image';
            $message = $this->chatkit->sendMessage($options);
        }else{
            $message = $this->chatkit->sendSimpleMessage([
                'sender_id' => $my_id,
                'room_id' => $roomId,
                'text' => $request->message
            ]);
        }

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
        $opt['limit'] = 100;
        $users = $this->chatkit->getUsers($opt);
        foreach ($users['body'] as $key => $user) {
           $raw = "select avatar from users where id_pusher = '".$user['id']."'";
           if ($userQuery = DB::select($raw)){
               $users['body'][$key]['avatar'] = $userQuery[0]->avatar;
           }else{
                $users['body'][$key]['avatar'] = "https://i.picsum.photos/id/".rand(100, 999)."/200/200.jpg";
           }
        }
        return response($users);
    }
}
