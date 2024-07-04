<?php

namespace App\Http\Controllers\Api\garage;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->all();

        $validateData = Validator::Make($data, [
            'name' => 'required|string',
            'email' => 'required|email:dns|unique:garages',
            'password' => 'required|string:min:6',
            'phone' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',   
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }

        DB::beginTransaction();
        try {
            $profilePicture = null;

            if ($request->photo) {
                $profilePicture = uploadImage($request->photo);
            }

            $user = Garage::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'photo' => $profilePicture,
            ]);

            DB::commit();

            return response()->json([
                'status'=> 'success',
                'message'=> 'Garage registered successfully',
                'data'=> $user,
            ], 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validateData = Validator::Make($credentials, [
            'email' => 'required|email:dns',
            'password' => 'required|string:min:6',
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }

        $user = Garage::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login success',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout success'
        ], 200);
    }
}