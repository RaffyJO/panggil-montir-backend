<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
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
            $motorcycles = Motorcycle::with('brand', 'type', 'variant', 'productionYear')
                ->where('user_id', $user->id)
                ->get();

            $motorcyclesWithDetails = $motorcycles->map(function($motorcycle) {
                return [
                    'id' => $motorcycle->id,
                    'license_plate' => $motorcycle->license_plate,
                    'brand' => $motorcycle->brand,
                    'type' => $motorcycle->type,
                    'variant' => $motorcycle->variant,
                    'production_year' => $motorcycle->productionYear,
                    'is_selected' => $motorcycle->is_selected,
                ];
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Get motorcycles success',
                'data' => $motorcyclesWithDetails,
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

            $motorcycle = $request->validate([
                'license_plate' => 'required|string',
                'brand_id' => 'required|exists:brands,id',
                'type_id' => 'required|exists:types,id',
                'variant_id' => 'required|exists:variants,id',
                'production_year_id' => 'required|exists:production_years,id',
            ]);

            $isSelected = false;
            if ($user->motorcycles->count() == 0) {
                $isSelected = true;
            }

            $newMotorcycle = Motorcycle::create([
                'user_id' => $user->id,
                'license_plate' => $motorcycle['license_plate'],
                'brand_id' => $motorcycle['brand_id'],
                'type_id' => $motorcycle['type_id'],
                'variant_id' => $motorcycle['variant_id'],
                'production_year_id' => $motorcycle['production_year_id'],
                'is_selected' => $isSelected,
            ]);

            $motorcycleWithDetails = Motorcycle::with('brand', 'type', 'variant', 'productionYear')
                ->where('user_id', $user->id)
                ->where('id', $newMotorcycle->id)
                ->first();

            if ($motorcycleWithDetails) {
                $motorcycleWithDetails = [
                    'id' => $motorcycleWithDetails->id,
                    'license_plate' => $motorcycleWithDetails->license_plate,
                    'brand' => $motorcycleWithDetails->brand,
                    'type' => $motorcycleWithDetails->type,
                    'variant' => $motorcycleWithDetails->variant,
                    'production_year' => $motorcycleWithDetails->productionYear,
                    'is_selected' => $motorcycleWithDetails->is_selected,
                ];
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Save motorcycle success',
                'data' => $motorcycleWithDetails,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function changeSelected($id) {
        try {
            $user = auth()->user();
            $motorcycles = $user->motorcycles;

            $newSelectedMotorcycle = $motorcycles->where('id', $id)->first();

            if ($newSelectedMotorcycle) {
                $oldSelectedMotorcycle = $motorcycles->where('is_selected', 1)->first();
                $oldSelectedMotorcycle->is_selected = 0;
                $oldSelectedMotorcycle->save();
                
                $newSelectedMotorcycle->is_selected = 1;
                $newSelectedMotorcycle->save();

                $allMotorcycles = $user->motorcycles;

                $motorcyclesWithDetails = $allMotorcycles->map(function($motorcycle) {
                    return [
                        'id' => $motorcycle->id,
                        'license_plate' => $motorcycle->license_plate,
                        'brand' => $motorcycle->brand,
                        'type' => $motorcycle->type,
                        'variant' => $motorcycle->variant,
                        'production_year' => $motorcycle->productionYear,
                        'is_selected' => $motorcycle->is_selected,
                    ];
                });

                return response()->json([
                    'status' => 'success',
                    'message' => 'Change selected motorcycle success',
                    'data' => $motorcyclesWithDetails,
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Motorcycle not found'
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
