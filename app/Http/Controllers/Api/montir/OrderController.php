<?php

namespace App\Http\Controllers\Api\montir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function listOrders()
    {
        try {
            $orders = Order::with([
                'orderType',
                'user',
                'garage',
                'motorcycle',
                'montir',
                'payment',
                'services.service'
            ])->where('status', 'started')->orderBy('order_date', 'desc')->get();

            $ordersWithDetails = $orders->map(function($order) {
                return [
                    'order' => [
                        'id' => $order->id,
                        'code' => $order->code,
                        'order_date' => $order->order_date,
                        'booked_date' => $order->booked_date,
                        'completed_date' => $order->completed_date,
                        'service_fee' => $order->service_fee,
                        'application_fee' => $order->application_fee,
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
                        'production_year' => $order->motorcycle->productionYear,
                    ] : [
                        'license_plate' => '',
                        'brand' => [
                            'name' => '',
                        ],
                        'type' => [
                            'name' => '',
                        ],
                        'variant' => [
                            'name' => '',
                        ],
                        'production_year' => [
                            'year' => '',
                        ],
                    ],
                    'customer' => $order->user ? [
                        'name' => $order->user->name,
                        'phone' => $order->user->phone,
                        'photo' => $order->user->photo,
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
                'message' => 'Get orders success',
                'data' => $ordersWithDetails,
            ], 200);

         } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function acceptOrder(Request $request)
    {
        try {
            $montir = auth('montir')->user();

            if (!$montir) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda belum login atau token tidak valid.',
                ], 401);
            }

            $order = Order::where('code', $request->code)->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found',
                    'data' => [],
                ], 404);
            }

            $montirLatitude = $request->latitude;
            $montirLongitude = $request->longitude;
            $orderLatitude = (double)$order->latitude;
            $orderLongitude = (double)$order->longitude;

            // Calculate distance between two points
            function toRadians($degrees) {
                return $degrees * (pi() / 180);
            }
            
            $earthRadius = 6371; // Radius Bumi dalam kilometer
            
            $latDistance = toRadians($orderLatitude - $montirLatitude);
            $lonDistance = toRadians($orderLongitude - $montirLongitude);
            
            $a = sin($latDistance / 2) * sin($latDistance / 2) +
                 cos(toRadians($montirLatitude)) * cos(toRadians($orderLatitude)) *
                 sin($lonDistance / 2) * sin($lonDistance / 2);
            
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            
            $calculateDistance = round($earthRadius * $c, 2);
            $deliveryFee = $calculateDistance * 3000;

            // Membulatkan hasil ke ribuan
            $roundedDeliveryFee = round($deliveryFee / 1000) * 1000;
            
            $order->delivery_fee = $roundedDeliveryFee;
            $order->montir_id = $montir->id;
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Accept order success',
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
