<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index($id){
        try {
            $variants = Variant::select('id', 'name')
                ->where('type_id', $id)
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Get variants success',
                'data' => $variants,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
