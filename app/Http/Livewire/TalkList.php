<?php

namespace App\Http\Livewire;

use App\Models\Talk;
use Livewire\Component;

class TalkList extends Component
{
    public $talks;

    public Talk $talk;

    public $rules = [
        'talk.subject' => 'required'
    ];

    public $messages = [
        'talk.subject.required' => 'veuiller renseigner un sujet de discussion'
    ];

    public function mount()
    {
        $this->talks = Talk::with('messages')->get();
        $this->talk = new Talk();
    }

    public function render()
    {
        return view('livewire.talk-list', ['talks' => $this->talks]);
    }

    public function newTalk()
    {
        $this->validate($this->rules, $this->messages);
        $this->talk->save();
        return redirect()->to('/'.$this->talk->id);
    }
}
