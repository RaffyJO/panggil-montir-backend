<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    public function getCurrentMotorcycle()
    {
        try {
            $user = auth()->user();
            $motorcycles = $user->motorcycles->where('is_selected', true)->first();

            return response()->json([
                'status' => 'success',
                'message' => 'Get motorcycles success',
                'data' => $motorcycles,
            ], 200);

         } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(){
        try {
            $user = auth()->user();
            $motorcycles = $user->motorcycles;

            return response()->json([
                'status' => 'success',
                'message' => 'Get motorcycles success',
                'data' => $motorcycles,
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
            $motorcycle = $request->all();

            $user->motorcycles->create($motorcycle);

            return response()->json([
                'status' => 'success',
                'message' => 'Save motorcycle success',
                'data' => $motorcycle,
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
            $motorcycle = $request->all();

            $user->motorcycles->where('id', $id)->update($motorcycle);

            return response()->json([
                'status' => 'success',
                'message' => 'Update motorcycle success',
                'data' => $motorcycle,
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
            $motorcycles = $user->motorcycles;
    
            // Check if there's only one motorcycle left
            if ($motorcycles->count() == 1) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete the only motorcycle',
                ], 400);
            }
    
            // Find the motorcycle to be deleted
            $motorcycle = $motorcycles->where('id', $id)->first();
    
            if ($motorcycle) {
                // Check if the motorcycle is selected
                if ($motorcycle->is_selected) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Cannot delete the selected motorcycle'
                    ], 400);
                }
    
                // Delete the motorcycle
                $motorcycle->delete();
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Delete motorcycle success',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'motorcycle not found'
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
