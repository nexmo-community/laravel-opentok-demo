<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use OpenTok\OpenTok;

class RoomController extends Controller
{
    protected $key;
    /**
     * @var OpenTok
     */
    protected $opentok;

    public function __construct(OpenTok $opentok)
    {
        $this->key = Config::get('OPENTOK_KEY');
        $this->opentok = $opentok;
    }

    public function joinRoom(string $name)
    {
        $room = Room::where('name', $name)->first();

        if (!$room) {
            $session = $this->opentok->createSession();
            $room = new Room([
                'name' => $name,
                'session_id' => $session->getSessionId()
            ]);
            $room->save();
        }

        $this->opentok->signal(
            $room->session_id,
            [
                'type' => 'user-join',
                'data' => json_encode([
                    'username' => Auth::user()->name
                ])
            ]
        );

        return view('room', [
            'apiKey' => $this->key,
            'sessionId' => $room->session_id,
            'token' => $this->opentok->generateToken($room->session_id),
            'roomName' => $name
        ]);
    }
}
