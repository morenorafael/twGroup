<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.bookings.index', [
            'bookings' => Booking::all(),
        ]);
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', [
            'booking' => $booking,
        ]);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }
}
