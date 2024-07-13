<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderType;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = auth()->user();
            $perPage = 10; // Jumlah data per halaman
            $page = $request->input('page', 1); // Halaman saat ini, default ke 1 jika tidak ada

            $history = Order::with([
                'orderType',
                'user',
                'garage',
                'motorcycle',
                'montir',
                'payment',
                'services.service'
            ])->where('user_id', $user->id)->paginate($perPage, ['*'], 'page', $page);

            $historyWithDetails = $history->map(function($order) {
                return [
                    'order' => [
                        'id' => $order->id,
                        'code' => $order->code,
                        'order_date' => $order->order_date,
                        'booked_date' => $order->booked_date,
                        'completed_date' => $order->completed_date,
                        'service_fee' => $order->service_fee,
                        'delivery_fee' => $order->delivery_fee,
                        'issue' => $order->issue,
                        'notes' => $order->notes,
                        'address' => $order->address,
                        'latitude' => $order->latitude,
                        'longitude' => $order->longitude,
                        'status' => $order->status,
                    ],
                    'order_type' => $order->orderType ? [
                        'name' => $order->orderType->name,
                        'code' => $order->orderType->code,
                    ] : null,
                    'garage' => $order->garage ? [
                        'name' => $order->garage->name,
                        'address' => $order->garage->address,
                        'phone' => $order->garage->phone,
                    ] : null,
                    'motorcycle' => $order->motorcycle ? [
                        'license_plate' => $order->motorcycle->license_plate,
                        'brand' => $order->motorcycle->brand,
                        'type' => $order->motorcycle->type,
                        'variant' => $order->motorcycle->variant,
                        'production_year' => $order->motorcycle->production_year,
                    ] : null,
                    'montir' => $order->montir ? [
                        'name' => $order->montir->name,
                        'phone' => $order->montir->phone,
                        'photo' => $order->montir->photo,
                    ] : null,
                    'payment' => $order->payment ? [
                        'code' => $order->payment->code,
                        'name' => $order->payment->name,
                        'thumbnail' => $order->payment->thumbnail,
                    ] : null,
                    'services' => $order->services ? $order->services->map(function($orderDetail) {
                        return [
                            'service_name' => $orderDetail->service->name,
                            'price' => $orderDetail->service->price,
                        ];
                    }) : null,
                ];
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Get history success',
                'data' => $historyWithDetails,
                'current_page' => $history->currentPage(),
                'last_page' => $history->lastPage(),
                'total' => $history->total(),
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
