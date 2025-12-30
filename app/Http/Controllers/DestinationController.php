<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);

        return response()->json([
            'destinations'=>$destinations
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
"name"=>['required','string'],
"location"=>['required','string'],
"image"=>["required",'image']

        ]);

        $exist = Destination::where('name',$request->name)->first();
        if($exist){
            return response()->json(["error"=>"destination already Exisist "],401);
        }


$data['image']= $request->file('image')->store('destinations', 'public');

       $destination = Destination::create([
        "name"=>$request->name,
        "location"=>$request->location,
        "image_url"=>$data['image']

       ]);

       return response()->json([
        "destination"=>$destination
       ]);
  
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        
        return response()->json([
            "destination"=>$destination
           ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return response(["message"=>"successfull deleted "]);
    }
}
