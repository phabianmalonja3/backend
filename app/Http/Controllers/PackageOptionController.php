<?php

namespace App\Http\Controllers;

use App\Models\PackageOption;
use Illuminate\Http\Request;

class PackageOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = PackageOption::all();

        return response()->json([
            "options"=>$options
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
        // $package
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageOption $packageOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageOption $packageOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageOption $packageOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageOption $packageOption)
    {
        //
    }
}
