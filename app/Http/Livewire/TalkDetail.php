<?php

namespace App\Http\Livewire;

use App\Models\Talk;
use App\Models\User;
use App\Models\Message;
use App\Http\Service\MailService;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class TalkDetail extends Component
{
    public Talk $talk;
    public User $user;
    public string $name = "", $email ="", $text = "";

    public $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'text' => 'required'
    ];

    public $messages = [
        'name.required' => 'Veuiller renseigner votre nom',
        'name.unique' => 'Ce nom a déja été utilisé, veuiller en sélectionner un autre',
        'email.required' => 'Veuiller renseigner votre adresse mail',
        'email.unique' => 'Cette adresse mail a déja été utilisé, veuiller en sélectionner un autre',
        'email.email' => 'L\'information inscrite ne correspond pas à une adresse mail',
        'text.required' => 'Veuiller écrire quelque chose pour l\'envoyer'
    ];

    public function mount(int $id)
    {
        $this->talk = Talk::with('messages')->with('messages.author')->find($id);
        if (Cookie::get('user')) {
            $this->user = User::find(Cookie::get('user'));
            $this->name = $this->user->name;
            $this->email = $this->user->email;
        } else {
            $this->user = new User();
        }
    }

    public function render()
    {
        return view('livewire.talk-detail',['talk' => $this->talk, 'user' => $this->user]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * post message on this talk
     * @return RedirectResponse page refresh
     */
    public function postMessage()
    {
        $this->validate($this->rules,$this->messages);
        if ($this->user->id == null && $this->name != $this->user->name) {
                $user = User::firstOrCreate([
                'name' => $this->name,
                'email' => $this->email
            ]);
            $this->user = $user;
        }
        Cookie::queue('user',$this->user->id,36000);

        $message = new Message(['text' => $this->text]);
        $message->talk()->associate($this->talk);
        $message->author()->associate($this->user);
        $message->save();

        MailService::sendNewMessageMail($message, $this->talk);
        return redirect()->to('/'.$this->talk->id);
    }
}
