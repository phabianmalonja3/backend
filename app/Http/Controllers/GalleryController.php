<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $galleries = Gallery::with('category')->latest()->paginate(10);
        return response()->json([
            'galleries' => $galleries
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
        $request->validate([
    'category_id' => 'required|exists:categories,id',
    'image' => 'required|image',
    'description' => 'required|string',
]);

// Handle file upload
$path = $request->file('image')->store('gallery', 'public');
$gallery = Gallery::create([
    'category_id' => $request->category_id,
    'image_path' => $path,
    'description' => $request->description,
]);
return response()->json(['gallery' => $gallery], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load('category');
        return response()->json(['gallery' => $gallery]);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response()->json(["message"=>"Success deleted"]);
    }
}
