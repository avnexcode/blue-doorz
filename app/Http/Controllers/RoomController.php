<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomCreateRequest;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.room.index', [
            'title' => "Dashboard Room",
            'rooms' => Room::get()
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

        $validatedData['slug'] = $this->generateSlug($validatedData['name']);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('assets/images/rooms');
        }

        Room::create($validatedData);
        Alert::success('Berhasil', 'Menambahkan Data Room Baru');

        return redirect(route('rooms.index'))->with('succes', 'Aku sudah bisa laravel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }

    protected function generateSlug(string $name): string
    {
        return strtolower(str_replace(' ', '-', $name));
    }
}
