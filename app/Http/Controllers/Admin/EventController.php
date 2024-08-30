<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->user()->id)->latest()->paginate(10);
        $all_events = Event::latest()->paginate(10);
        return view('admin.page.timeline.index', compact('events', 'all_events'));
    }

    public function destroy(Event $event,ToastrFactory $flasher)
    {
        $event->delete();
        $flasher->addSuccess('رویداد حذف گردید');
        return back();

    }
}
