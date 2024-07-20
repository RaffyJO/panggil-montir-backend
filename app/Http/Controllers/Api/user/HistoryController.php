<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();

            $history = Order::with([
                'orderType',
                'user',
                'garage',
                'motorcycle',
                'montir',
                'payment',
                'services.service'
            ])->where('user_id', $user->id)->get();

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
                    ] : [
                        'name' => '',
                        'address' => '',
                        'phone' => '',
                    ] ,
                    'motorcycle' => $order->motorcycle ? [
                        'license_plate' => $order->motorcycle->license_plate,
                        'brand' => $order->motorcycle->brand,
                        'type' => $order->motorcycle->type,
                        'variant' => $order->motorcycle->variant,
                        'production_year' => $order->motorcycle->production_year,
                    ] : [
                        'license_plate' => '',
                        'brand' => '',
                        'type' => '',
                        'variant' => '',
                        'production_year' => '',
                    ],
                    'montir' => $order->montir ? [
                        'name' => $order->montir->name,
                        'phone' => $order->montir->phone,
                        'photo' => $order->montir->photo,
                    ] : [
                        'name' => '',
                        'phone' => '',
                        'photo' => '',
                    ],
                    'payment' => $order->payment ? [
                        'code' => $order->payment->code,
                        'name' => $order->payment->name,
                        'thumbnail' => $order->payment->thumbnail,
                    ] : [
                        'code' => '',
                        'name' => '',
                        'thumbnail' => '',
                    ] ,
                    'services' => $order->services ? $order->services->map(function($orderDetail) {
                        return [
                            'service_name' => $orderDetail->service->name,
                            'price' => $orderDetail->service->price,
                        ];
                    }) :  [
                        'service_name' => '',
                        'price' => 0,
                    ],
                ];
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Get history success',
                'data' => $historyWithDetails,
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
