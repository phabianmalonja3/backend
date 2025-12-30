<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Display a listing of the resource.
     */
   
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
        //
    }
    public function login(Request $request)
    {

        $validated = $request->validate([
            'email'=>['required','email','string'],
            'password'=>['required','min:3']
        ]);


        
        $auth = Auth::attempt($validated);
      



        if (!$auth) {
            return response()->json([
                "error"=>"invalid Credentials"
            ],401);

        } 


        $user =  $request->user();

        $user->tokens()->delete();

        $token = $user->createToken("web_token")->plainTextToken;


        return response()->json([
            "access_token"=>$token,
            "user"=>$user
        ]);

        
    }
    public function logoutFun(Request $request)
    {



         $request->user()->currentAccessToken()->delete();



        return response()->json([
            "message"=>"Your Logout",
            
        ]);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
