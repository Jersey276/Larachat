<?php

namespace App\Http\Livewire;

use App\Models\Talk;
use App\Models\User;
use App\Models\Message;
use App\Http\Service\MailService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class TalkDetail extends Component
{
    public Talk $talk;
    public User $user;
    public Message $newMessage;

    public $rules = [
        'user.name' => 'required|unique:users',
        'user.email' => 'required|email|unique:users',
        'message.text' => 'required'
    ];

    public function mount(Request $request, int $id)
    {
        $this->talk = Talk::with('messages')->with('messages.author')->find($id);
        if (Cookie::get('user')) {
            $this->user = User::find(Cookie::get('user'));
        } else {
            $this->user = new User();
        }
        $this->message = new Message();
    }

    public function render()
    {
        return view('livewire.talk-detail',['talk' => $this->talk, 'user' => $this->user]);
    }

    /**
     * post message on this talk
     * @param Request $request
     * @return RedirectResponse page refresh
     */
    public function postMessage(Request $request)
    {
        if ($this->user->id == null) {
                $user = User::firstOrCreate([
                'name' => $this->user->name,
                'email' => $this->user->email
            ]);
            $this->user = $user;
        }
        Cookie::queue('user',$this->user->id,36000);
        $this->message->talk()->associate($this->talk);
        $this->message->author()->associate($this->user);

        $this->message->save();
        MailService::sendNewMessageMail($this->message, $this->talk);
        return redirect()->to('/'.$this->talk->id);
    }
}
