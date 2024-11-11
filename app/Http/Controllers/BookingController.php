<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $rooms = Room::all();

        return view('bookings.create', [
            'rooms' => $rooms,
        ]);
    }

    public function store(StoreBookingRequest $request)
    {
        $startTime = str_replace('T', ' ', $request->input('reserved_for'));
        $startTime = Carbon::parse($startTime.':00');

        $endTime = $startTime->copy()->addMinutes(30);

        $exists = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('reserved_for', [$startTime, $endTime]);
            })
            ->exists();

        if ($exists) {
            return redirect()->route('bookings.create')
                ->withErrors(['reserved_for' => __('This time slot is already reserved.')]);
        }

        Booking::create([
            'reserved_for' => $request->input('reserved_for'),
            'user_id' => Auth::user()->id,
            'room_id' => $request->input('room_id'),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        //
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    public function destroy(Booking $booking)
    {
        //
    }
}
