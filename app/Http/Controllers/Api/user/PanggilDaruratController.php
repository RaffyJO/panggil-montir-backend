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
                    'application_fee' => 2000,
                    'service_fee' => $data['service_fee'],
                    'issue' => $data['issue'],
                    'notes' => $data['notes'],
                    'address' => $data['address'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'status' => 'started',
                ]);

                DB::commit();

                $orderWithDetails = [
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
                    'montir' => $order->montir ? [
                        'name' => $order->montir->name,
                        'phone' => $order->montir->phone,
                        'licence_plate' => $order->montir->licence_plate,
                        'photo' => $order->montir->photo,
                    ] : [
                        'name' => '',
                        'phone' => '',
                        'licence_plate' => '',
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

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order created successfully',
                    'data' => $orderWithDetails,
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

    public function getCurrentOrder($order_code) {
        try {
            $user = auth()->user();

            if (!$order_code) {
                return response()->json(['error' => 'Order code not found'], 404);
            }

            $order = Order::where('code', $order_code)->where('user_id', $user->id)->first();

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            $orderWithDetails = [
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
                'montir' => $order->montir ? [
                    'name' => $order->montir->name,
                    'phone' => $order->montir->phone,
                    'licence_plate' => $order->montir->licence_plate,
                    'latitude' => $order->montir->latitude,
                    'longitude' => $order->montir->longitude,
                    'photo' => $order->montir->photo,
                ] : [
                    'name' => '',
                    'phone' => '',
                    'licence_plate' => '',
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

            return response()->json([
                'status' => 'success',
                'message' => 'Order found successfully',
                'data' => $orderWithDetails,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function cancelOrder($order_code) {
        try {
            $user = auth()->user();

            if (!$order_code) {
                return response()->json(['error' => 'Order code not found'], 404);
            }

            $order = Order::where('code', $order_code)->where('user_id', $user->id)->first();

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            $order->status = 'cancelled';
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Order canceled successfully',
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
