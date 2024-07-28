<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index($id){
        try {
            $types = Type::select('id', 'name')
                ->where('brand_id', $id)
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Get types success',
                'data' => $types,
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
