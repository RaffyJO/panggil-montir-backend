<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\ProductionYear;
use Illuminate\Http\Request;

class ProductionYearController extends Controller
{
    public function index(){
        try {
            $productionYears = ProductionYear::select('id', 'year')->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Get production years success',
                'data' => $productionYears,
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
