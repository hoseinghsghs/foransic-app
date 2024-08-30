<?php

namespace App\Livewire\Admin\Events;


use App\Models\Event;
use Livewire\Component;

class EventList extends Component
{
public $evorders;

    protected $listeners= [

        'echo-private:AdminNotification,NotificationMessage' => 'notifyNewOrder'
    ];

    public function mount(){
        $this->evorders= Event::orderBy('id', 'desc')->take(6)->get();

    }

    public function notifyNewOrder($payload)
    {
        $this->dispatch('say-sound');
        $this->evorders->prepend(Event::find($payload['event']['id']));

    }

    public function render()
    {
        $events = Event::where('user_id', auth()->user()->id)->latest()->paginate(10);
       $evorders =$this->evorders;
        return view('livewire.admin.events.event-list', compact('evorders', 'events'));
    }
}
