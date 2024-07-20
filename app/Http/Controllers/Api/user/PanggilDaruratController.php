<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PanggilDaruratController extends Controller
{
    public function findMontir(Request $request) {
        try {
            $user = auth()->user();
            $data = $request->all();

            $validateData = Validator::make($data, [
                'service_fee' => 'required|numeric',
                'issue' => 'required|string',
                'notes' => 'nullable|string',
                'address' => 'required|string',
                'latitude' => 'required|string',
                'longitude' => 'required|string',
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            DB::beginTransaction();
            try {
                $orderCode = 'PD-' . strtoupper(Str::random(10));

                $order = Order::create([
                    'code' => $orderCode,
                    'order_type_id' => 2,
                    'user_id' => $user->id,
                    'order_date' => Carbon::now(),
                    'service_fee' => $data['service_fee'],
                    'issue' => $data['issue'],
                    'notes' => $data['notes'],
                    'address' => $data['address'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'status' => 'started',
                ]);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order created successfully',
                    'data' => $order,
                ], 201);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat memproses permintaan.',
                    'error' => $e->getMessage()
                ], 500);
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
