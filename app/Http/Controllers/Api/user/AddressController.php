<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();
            $addresses = $user->addresses;

            return response()->json([
                'status' => 'success',
                'message' => 'Get addresses success',
                'data' => $addresses,
            ], 200);

         } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = auth()->user();
            $address = $request->all();

            $user->addresses->create($address);

            return response()->json([
                'status' => 'success',
                'message' => 'Save address success',
                'data' => $address,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)    {
        try {
            $user = auth()->user();
            $address = $request->all();

            $user->addresses->where('id', $id)->update($address);

            return response()->json([
                'status' => 'success',
                'message' => 'Update address success',
                'data' => $address,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $user = auth()->user();
            $addresses = $user->addresses;
    
            // Check if there's only one address left
            if ($addresses->count() == 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete the only address'
                ], 400);
            }
    
            // Find the address to be deleted
            $address = $addresses->where('id', $id)->first();
    
            if ($address) {
                // Check if the address is selected
                if ($address->is_selected) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Cannot delete the selected address'
                    ], 400);
                }
    
                // Delete the address
                $address->delete();
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Delete address success',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Address not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }    
}
