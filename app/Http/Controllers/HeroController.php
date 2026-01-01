<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = Hero::latest()->paginate(10);

        return response()->json([
            'heroes'=>$heroes
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

$data = $request->validate([
"title"=>['required','string'],
"subtitle"=>['required','string'],
"image"=>["required",'image']]);

      
$data['image']= $request->file('image')->store('heroes', 'public');

       $hero = Hero::create([
        "title"=>$request->title,
        "subtitle"=>$request->subtitle,
        "image_url"=>$data['image']
       ]);

       return response()->json([
        "hero"=>$hero
       ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        // Storage::delete($hero->image_path);

        $hero->delete();

        return response()->json(["message"=>"Success deleted"]);

    }
}
