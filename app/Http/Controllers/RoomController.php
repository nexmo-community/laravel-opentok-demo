<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
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

    public function joinRoom()
    {
        $room = Room::where('name', 'demo-room')->first();

        if (!$room) {
            $session = $this->opentok->createSession();
            $room = new Room([
                'name' => 'demo-room',
                'session_id' => $session->getSessionId()
            ]);
            $room->save();
        }

        dd($room->id, $room->session_id);
    }
}
