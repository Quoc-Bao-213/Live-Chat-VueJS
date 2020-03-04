<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
     * Show the welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userId = $request->session()->get('chatkit_id');

        if (!is_null($userId)) {
            // Redirect user to Chat Page
            return redirect('chat/1');
        }
        return view('welcome');
    }

    /**
     * The user joins chat room.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function join(Request $request)
    {
        $this->roomId = '34c69f79-77b2-4c41-ae30-dd709182ef96';

        $chatkit_id = strtolower(Str::random(5));

        // Create User account on Chatkit
        $this->chatkit->createUser([
            'id' =>  $chatkit_id,
            'name' => $request->username,
        ]);

        $this->chatkit->addUsersToRoom([
            'room_id' => $this->roomId,
            'user_ids' => [$chatkit_id],
        ]);

        // Add User details to session
        $request->session()->push('chatkit_id', $chatkit_id);

        // Redirect user to Chat Page
        return redirect('/chat/1');
    }

    /**
     * Show the application chat room.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function chat(Request $request)
    {
        $userId = $request->session()->get('chatkit_id')[0];

        if (preg_match('/^[1-4]$/', $request->roomid)){
            $roomName = $request->roomid;
        }else{
            $roomName = 1;
        }

        $groupID = $request->roomid;

        switch ($groupID) {
            case 1:
                $this->roomId = '34c69f79-77b2-4c41-ae30-dd709182ef96';
                break;
            case 2:
                $this->roomId = '56b9f7ad-1bec-475a-bc83-34d3f497f30c';
                break;
            case 3:
                $this->roomId = 'ece3f102-0d5e-4b4e-b203-2ff0fe825f84';
                break;
            case 4:
                $this->roomId = '00f230e9-025a-4578-a86b-4a3423506d30';
                break;
            default:
                $this->roomId = '34c69f79-77b2-4c41-ae30-dd709182ef96';
        }

        $roomId = $this->roomId;

        $request->session()->put('room_id', $roomId);

        if (is_null($userId)) {
            $request->session()->flash('status', 'Join to access chat room!');
            return redirect(url('/'));
        }

        // Get messages via Chatkit
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

        return view('chat')->with(compact('messages', 'roomId', 'userId', 'roomName'));
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

        return redirect(url('/'));
    }
}
