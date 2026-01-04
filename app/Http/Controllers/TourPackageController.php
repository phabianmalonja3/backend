<?php

namespace App\Http\Controllers;

use App\Models\PackageOption;
use App\Models\TourPackage;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Storage;

class TourPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request, $locationName = null)
{
    $query = TourPackage::with("location");

    // If a location name is passed in the URL or as a query param
    if ($locationName) {
        $query->whereHas('location', function ($q) use ($locationName) {
            // Using 'like' makes it more flexible (e.g., 'zanzibar' matches 'Zanzibar')
            $q->where('name', 'like', '%' . $locationName . '%');
        });
    }

    $packages = $query->latest()->get();

    return response()->json([
        "packages" => $packages,
        "current_location" => $locationName // Useful for UI headers
    ]);
}


    public function store(Request $request)
    {
        // 1. Validation (Highly recommended to prevent 500 errors)
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'location_id' => 'required|exists:locations,id',
            'image' => 'required|image'
        ]);

        $options = [];
        // Map the IDs coming from frontend to actual names/values
        if ($request->has("options")) {
            foreach ($request->get("options") as $optionId) {
                $option = PackageOption::find($optionId);
                if ($option) {
                    $options[] = $option->options; 
                }
            }
        }

        $path = $request->file('image')->store('packages', 'public');

        // 2. Create with UUID
        $pk = TourPackage::create([ // Generate the UUID here
            "name" => $request->name,
            "price" => $request->price,
            "image_url" => $path,
            "options" => $options, // Laravel will JSON encode this via Model cast
            "location_id" => $request->location_id,
            "active" => true
        ]);

        return response()->json(["package" => $pk], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(TourPackage $tourPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourPackage $tourPackage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TourPackage $tourPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $tourPackage = TourPackage::findorFail($id);

        $exist = Storage::exists($tourPackage->image_url);
        if($exist){
            Storage::delete($tourPackage);
        }
        $tourPackage->delete();

        return response()->json([
            "message"=>"succesfull"
        ]);
    }
}
