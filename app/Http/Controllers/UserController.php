<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function login(Request $request) {

        $email = $request->get('email');

        try {

            throw_if(!Auth::attempt($request->only('email', 'password')), new Exception('Usuario incorrecto', 400));
                
            $user = User::where(['email' => $email])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);

        } catch(Exception $e){
            
            if($e->getCode() === 400){
                return response($e->getMessage(), $e->getCode());   
            }

            return response($e->getMessage());
        
        }

    }

}
