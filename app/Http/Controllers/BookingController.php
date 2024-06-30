<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\TransactionCreateRequest;

class BookingController extends Controller
{
    public function index($id)
    {
        $room = Room::findOrFail($id);
        return view('pages.home.booking', [
            "title" => "Booking Page",
            "room" => $room
        ]);
    }

    public function store(TransactionCreateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = 'pending';
        $validatedData['user_id'] = auth()->id();
        $validatedData['price'] = $this->calculatePrice($validatedData);

        if ($this->isRoomAvailable($validatedData['room_id'])) {
            $this->reserveRoom($validatedData['room_id']);
            $this->createTransaction($validatedData);
            $this->triggerSuccessNotification();
            return redirect()->route('pages.home');
        } else {
            return redirect()->back()->with('error', 'The selected room is not available.');
        }
    }

    private function calculatePrice(array $data)
    {
        $startedTime = Carbon::parse($data['started_time']);
        $endTime = Carbon::parse($data['end_time']);
        $numberOfDays = $startedTime->diffInDays($endTime);
        return $numberOfDays * $data['price'];
    }

    private function isRoomAvailable(int $roomId)
    {
        $room = Room::findOrFail($roomId);
        return $room->status == 'available';
    }

    private function reserveRoom(int $roomId)
    {
        $room = Room::findOrFail($roomId);
        $room->status = 'booked';
        $room->save();
    }

    private function createTransaction(array $data)
    {
        Transaction::create($data);
    }

    private function triggerSuccessNotification()
    {
        Alert::success('Success', 'Room booked successfully.');
    }
}