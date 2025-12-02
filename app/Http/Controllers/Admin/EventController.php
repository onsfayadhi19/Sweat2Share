<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event; // ← juste un "use"
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date')->orderBy('time')->get();
        return view('dashboards.admin.events', compact('events'));
    }

    public function store(Request $request)
    {    
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_month' => 'required|numeric|between:1,12',
            'date_day' => 'required|numeric|between:1,31',
            'date_year' => 'required|numeric|between:2020,2030',
            'time' => 'required',
        ]);

        $date = $request->date_year . '-' . $request->date_month . '-' . $request->date_day;
        $time = $request->time;

        try {
        $event = Event::create([
            'title' => $request->title,
            'location' => $request->location,
            'date' => $date,
            'time' => $time,
        ]);

        \Log::info('Event created successfully', ['id' => $event->id]);
        return redirect()->route('admin.events')->with('success', 'Event created successfully!');
    } catch (\Exception $e) {
        \Log::error('Error creating event', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->withErrors(['error' => 'Failed to create event: ' . $e->getMessage()]);
    }
    }

    public function destroy(Event $event)
    {
        $event->forceDelete();
        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date_month' => 'required|integer|between:1,12',
            'date_day' => 'required|integer|between:1,31',
            'date_year' => 'required|integer|between:2020,2030',
            'time' => 'required',
        ]);

        $date = $request->date_year . '-' . $request->date_month . '-' . $request->date_day;

        $event->update([
            'title' => $request->title,
            'location' => $request->location,
            'date' => $date,
            'time' => $request->time,
        ]);

        return response()->json(['success' => true]);
    }
}