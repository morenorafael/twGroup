<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(StoreRoomRequest $request)
    {
        Room::create($request->validated());

        return redirect()->route('admin.rooms.index')
            ->with('success', __('Room created successfully.'));
    }

    public function show(Room $room)
    {
        //
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());

        return redirect()->route('admin.rooms.index')
            ->with('success', __('Room updated successfully.'));
    }

    public function destroy(Room $room)
    {
        //
    }
}
