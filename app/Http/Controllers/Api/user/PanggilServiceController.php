<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;
use App\Models\Garage;
use Illuminate\Support\Str;
use App\Models\OperasionalHour;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\RatingGarage;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PanggilServiceController extends Controller
{
    public function getGaragesByUserLocation(Request $request)
    {
        try {
            $user = auth()->user();

            // Mengambil alamat pengguna yang memiliki is_selected bernilai true
            $selectedAddress = $user->addresses->where('is_selected', true)->first();

            // Mengambil latitude dan longitude dari alamat yang dipilih
            if ($selectedAddress) {
                $latitude = $selectedAddress->latitude;
                $longitude = $selectedAddress->longitude;
            } else {
                $addressRequest = $request->validate([
                    'latitude' => 'required|string',
                    'longitude' => 'required|string',
                ]);

                $latitude = $addressRequest['latitude'];
                $longitude = $addressRequest['longitude'];
            }

            $perPage = 10; // Jumlah data per halaman
            $page = $request->input('page', 1); // Halaman saat ini, default ke 1 jika tidak ada

            $garagesQuery = Garage::select(
                'id',
                'name',
                'email',
                'phone',
                'address',
                'latitude',
                'longitude',
                'photo',
                DB::raw("ROUND(6371 * acos(cos(radians($latitude)) 
                    * cos(radians(latitude)) 
                    * cos(radians(longitude) - radians($longitude)) 
                    + sin(radians($latitude)) 
                    * sin(radians(latitude))), 2) AS distance")
            )
            ->orderBy('distance');

            $garages = $garagesQuery->paginate($perPage, ['*'], 'page', $page);

            // Menghitung startPrice untuk setiap garage
            $garagesWithPrice = $garages->getCollection()->map(function ($garage) {
                // Menghitung rata-rata rating
                $averageRating = RatingGarage::where('garage_id', $garage->id)->where('is_done', true)->avg('rating');

                // Mengambil harga layanan terendah
                $startPrice = Service::where('garage_id', $garage->id)->min('price');

                // Mengambil jam operasional hari ini
                $operasionalHours = OperasionalHour::select('day', 'start_time', 'end_time')
                    ->where('garage_id', $garage->id)
                    ->get();

                $services = Service::select('id', 'name', 'price', 'description', 'is_available')
                    ->where('garage_id', $garage->id)->get();

                // Menambahkan informasi tambahan ke objek $garage
                $garage->average_rating = round($averageRating, 1);
                $garage->start_price = $startPrice;
                $garage->operasional_hours = $operasionalHours;
                $garage->services = $services;
                return $garage;
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Get garages success',
                'data' => $garagesWithPrice,
                'current_page' => $garages->currentPage(),
                'last_page' => $garages->lastPage(),
                'total' => $garages->total(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAddressByIsSelected(Request $request)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;

            $address = Address::where('user_id', $userId)->where('is_selected', true)->first();

            if (!$address) {
                $address = $request->validate([
                    'description' => 'required|string',
                    'latitude' => 'required|string',
                    'longitude' => 'required|string',
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Get address success',
                    'data' => $address,
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Get address success',
                'data' => $address,
            ], 200);

         } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getServicesByGarageId($id)
    {
        try {
            $services = Service::where('garage_id', $id)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Get services success',
                'data' => $services,
            ], 200);

         } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses permintaan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDetailGarageById($id)
    {
        try {
            $user = auth()->user();
            
            // Mengambil alamat pengguna yang memiliki is_selected bernilai true
            $selectedAddress = $user->addresses->where('is_selected', true)->first();

            // Mengambil latitude dan longitude dari alamat yang dipilih
            if ($selectedAddress) {
                $latitude = $selectedAddress->latitude;
                $longitude = $selectedAddress->longitude;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Selected address not found for the user.',
                ], 400);
            }

            $garage = Garage::select(
                'name', 
                'phone', 
                'address', 
                'latitude',     
                'longitude',
                'photo',
                DB::raw("ROUND(6371 * acos(cos(radians($latitude)) 
                    * cos(radians(latitude)) 
                    * cos(radians(longitude) - radians($longitude)) 
                    + sin(radians($latitude)) 
                    * sin(radians(latitude))), 2) AS distance")
            )
            ->where('id', $id)
            ->first();

            if ($garage) {
                // Menghitung rata-rata rating
                $averageRating = RatingGarage::where('garage_id', $id)->where('is_done', true)->avg('rating');

                // Mengambil harga layanan terendah
                $startPrice = Service::where('garage_id', $id)->min('price');

                // Mengambil jam operasional hari ini
                $today = strtolower(now()->format('l'));
                $operasionalHours = OperasionalHour::select('day', 'start_time', 'end_time')
                    ->where('garage_id', $id)
                    ->where('day', $today)
                    ->first();

                // Menambahkan informasi tambahan ke objek $garage
                $garage->average_rating = round($averageRating, 1);
                $garage->start_price = round($startPrice, 2);
                $garage->operasional_hours = $operasionalHours;

                return response()->json([
                    'status' => 'success',
                    'message' => 'Get garage detail success',
                    'data' => $garage,
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Garage not found.',
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

    public function storeOrder(Request $request)
    {
        try {
            $user = auth()->user();
            $data = $request->all();
            $address = $user->addresses->where('is_selected', true)->first();

            $validateData = Validator::make($data, [
                'garage_id' => 'required|exists:garages,id',
                'payment_id' => 'required|exists:payments,id',
                'booked_date' => 'required|date_format:Y-m-d H:i:s',
                'service_fee' => 'required|numeric',
                'issue' => 'required|string',
                'notes' => 'nullable|string',
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }

            DB::beginTransaction();
            try {
                $orderCode = 'PS-' . strtoupper(Str::random(10));

                $motorcycles = $user->motorcycles->where('is_selected', true)->first();

                $order = Order::create([
                    'code' => $orderCode,
                    'order_type_id' => 1,
                    'user_id' => $user->id,
                    'motorcycle_id' => $motorcycles->id,
                    'garage_id' => $data['garage_id'],
                    'payment_id' => $data['payment_id'],
                    'order_date' => Carbon::now(),
                    'booked_date' => $data['booked_date'],
                    'service_fee' => $data['service_fee'],
                    'issue' => $data['issue'],
                    'notes' => $data['notes'],
                    'address' => $address->description,
                    'latitude' => $address->latitude,
                    'longitude' => $address->longitude,
                    'status' => 'ongoing',
                ]);

                foreach ($data['services'] as $service) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'service_id' => $service['service_id'],
                    ]);
                }

                DB::commit();

                $order->load('services.service');

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
