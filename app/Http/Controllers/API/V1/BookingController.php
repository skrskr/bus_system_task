<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\API\Response;
use App\Http\Requests\API\BookingRequest;
use App\Models\Booking;
use App\Models\BusSeat;
use App\Http\Controllers\Controller;


class BookingController extends Controller
{
    
    public function index(BookingRequest $request)
    {
        $requestData = $request->validated();
        $fromCityCode = $requestData["from_city_code"];
        $toCityCode = $requestData["to_city_code"];
        $busId =  $requestData["bus_id"];

        $bookingSeatIds = Booking::where("bus_id", $busId)->where("to_city_code", ">", $fromCityCode)->pluck("seat_code")->toArray();
        $availableSeats = BusSeat::whereNotIn("seat_code", $bookingSeatIds)->get(['id', 'seat_code']);
        return Response::response($availableSeats, "List of available seats", null, Response::SUCCESS);
    }

    public function store(BookingRequest $request)
    {
        $requestData = $request->validated();
        $fromCityCode = $requestData["from_city_code"];
        $toCityCode = $requestData["to_city_code"];
        $seatCode = $requestData["seat_code"];
        $busId =  $requestData["bus_id"];
        $userId = auth()->id();

        $booking = Booking::create([
            'seat_code' => $seatCode,
            'from_city_code' => $fromCityCode,
            'to_city_code' => $toCityCode,
            'bus_id' => $busId,
            'user_id' => $userId,
        ]);

        return Response::response($booking, "Seat booked success", null, Response::SUCCESS);
    }
}
