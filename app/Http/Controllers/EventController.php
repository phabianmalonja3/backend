<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();

        return response()->json([
            "events"=>$events
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // 1. Validation Logic
    $validated = $request->validate([
        'images'       => ['required', 'array', 'min:1'], // Ensure at least one image
        'images.*'     => ['image', 'mimes:png,jpg,jpeg', 'max:2048'], // 2MB limit per image
        'description'  => ['required', 'string', 'min:10'],
        'title'        => ['required', 'string', 'max:255'],
        'location'     => ['required', 'string'],
        'category_id'  => ['required', 'exists:categories,id'],
    ]);

    $imageUrls = [];

    // 2. Handle File Uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            // Store the file and get the path (e.g., 'events/filename.jpg')
            $path = $file->store('events', 'public');
            
            // Generate the full URL for the frontend
            $imageUrls[] = asset('storage/' . $path);
        }
    }

    // 3. Create Event
    $event = Event::create([
        "title"       => $validated['title'],
        "descriptions" => $validated['description'],
        "images"      => $imageUrls, // Ensure your Model has 'images' in $casts as array
        "category_id" => $validated['category_id'],
        "location"    => $validated['location']
    ]);

    return response()->json([
        "message" => "Event created successfully",
        "event"   => $event
    ], 201);
}

/**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return response()->json([
            "event"=>$event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)

    {
        Storage::delete($event->images);
        $event->delete();

        return response()->json(["message"=>"Success deleted"]);
    }
}
