<?php

namespace App\Http\Controllers\Api\montir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->all();

        $validateData = Validator::Make($data, [
            'name' => 'required|string',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|string:min:6',
            'phone_number' => 'required|string',
            'license_plate' => 'required|string',
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

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone_number' => $request->phone_number,
                'license_plate' => $request->license_plate,
                'role' => 'montir',
                'photo' => $profilePicture,
            ]);

            DB::commit();

            return response()->json([
                'status'=> 'success',
                'message'=> 'Montir registered successfully',
                'data'=> $user,
            ], 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}