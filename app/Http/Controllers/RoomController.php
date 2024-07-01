<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomCreateRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Http\Resources\RoomResource;
use App\Models\Category;
use App\Models\Room;
use RealRashid\SweetAlert\Facades\Alert;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('category')->filter(request()->only('search', 'category'))->paginate(10);

        return view('pages.dashboard.room.index', [
            'title' => "Dashboard Room",
            'rooms' => RoomResource::collection($rooms)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.room.create', [
            'title' => "Create New Room",
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomCreateRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData = array_map(fn ($value) => is_string($value) ? strtolower($value) : $value, $validatedData);

        $validatedData['slug'] = $this->generateSlug($validatedData['name']);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('assets/images/rooms');
        }

        Room::create($validatedData);
        
        Alert::success('Berhasil', 'Menambahkan Data Room Baru');

        return redirect(route('rooms.index'))->with('success', 'Aku sudah bisa laravel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view("pages.dashboard.room.detail", [
            "title" => "Detail " . str_replace(' ', ' ', ucwords(str_replace('_', ' ', $room->name))),
            "room" => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view("pages.dashboard.room.edit", [
            "title" => "Room Update",
            "categories" => Category::get(),
            "room" => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomUpdateRequest $request, Room $room)
    {
        $validatedData = $request->validated();

        $validatedData = array_map(fn ($value) => is_string($value) ? strtolower($value) : $value, $validatedData);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('assets/images/rooms');
        } else {
            $validatedData['image'] = $room->image;
        }

        $room->update($validatedData);

        Alert::success('Berhasil', 'Memperbarui Data Ruangan');
        
        return redirect(route('rooms.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        Alert::success('Berhasil', 'Menghapus data.');
        return redirect(route('rooms.index'));
    }

    protected function generateSlug(string $name): string
    {
        return strtolower(str_replace(' ', '-', $name));
    }
}
