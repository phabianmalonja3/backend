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


public function index(Request $request)
{
    // 1. Start query with eager loading the 'category' relationship
    // This assumes you have a public function category() in your Event model
    $query = Event::with(['category']);

    // 2. Filter by category_id
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 3. Exclude current event
    if ($request->has('exclude')) {
        $query->where('id', '!=', $request->exclude);
    }

    // 4. Limit and Sort
    $limit = $request->query('limit', 100);
    $events = $query->latest()->limit($limit)->get();

    return response()->json([
        "events" => $events
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

if ($request->hasFile('images')) {
    foreach ($request->file('images') as $file) {

        // Ensure the file is valid
        if (!$file->isValid()) {
            continue;
        }

        // Store image
        $path = $file->store('events', 'public');

        // Extra safety check
        if ($path) {
            $imageUrls[] = url('storage/' . $path);
        }
    }
}

    // 3. Create Event
    $event = Event::create([
        "title"       => $validated['title'],
        "descriptions" => $validated['description'],
        "images"      => $imageUrls,
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
