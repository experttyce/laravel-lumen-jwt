<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
      $this->validate($request, [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required'
      ]);
      $data = $request->only('name','email', 'password');
      $data['password'] = Hash::make($data['password']);
      try {
        $user = User::create($data);
        return response()->json($user, 201);
      } catch (\Exception $e) {
        return response()->json(["error" => substr($e->getMessage(),0,70)]);
      }
      
    }
}
