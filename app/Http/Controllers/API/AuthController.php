<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        try {
            $user = null;
            $token = null;

            DB::transaction(function() use ($request, &$user, &$token) {
                $user = User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'password' =>  Hash::make($request->input('password'))
                ]);

                Address::create([
                    'address' => $request->input('address'),
                    'default' => true,
                    'user_id' => $user->id,
                ]);

                $token = $user->createToken('user_token')->plainTextToken;
            });            
            
            return response()->json(['user' => $user,'token' => $token], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in the registration'
            ]);
        }
    }

    public function login(LoginRequest $request) {
        try {
            $user = User::with(['directory' => function($q) {
                $q->where('default', true);
            }])->where('email', $request->input('email'))->firstOrfail();

            if(Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('user_token')->plainTextToken;
    
                return response()->json(['user' => $user,'token' => $token], 200);
            }

            return response()->json(['error' => 'Something went wrong in the login']);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'error' => 'Something went wrong in the login'
            ]);
        }
    }

    public function logout(LogoutRequest $request) {
        try {
            $user = User::findOrFail($request->input('user_id'));

            $user->tokens()->delete();            

            return response()->json('User logged out!', 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in the logout'
            ]);
        }
    }
}
