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
    public function index()
    {
        $packages = TourPackage::latest()->get();

        return response()->json([
            "packages"=>$packages
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
    'image' => ['required','image'],
    'price' => ['required',"numeric"],
    "name"=>['string','required'],
    "location"=>["required","string"]

]);




$options= [];

if($request->has("options")){
foreach ($request->get("options") as $option) {
    $options[] = PackageOption::findOrFail($option)->options;
}

}





// Handle file upload
$path = $request->file('image')->store('packages', 'public');

$pk =TourPackage::create([
    "name"=>$request->name,
    "price"=>$request->price,
    "image_url"=>$path,
    "options"=>$options,
    "location"=>$request->location
]);

return response()->json([
    "package"=>$pk
]);    
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
