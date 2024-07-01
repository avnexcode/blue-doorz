<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
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

        $startedTime = Carbon::parse($validatedData['started_time']);
        $endTime = Carbon::parse($validatedData['end_time']);
        $numberOfDays = $startedTime->diffInDays($endTime);

        $validatedData['total_day'] = $numberOfDays;
        $validatedData['total_price'] = $numberOfDays * $validatedData['total_price'];

        $room = Room::findOrFail($validatedData['room_id']);
        if ($room->status == 'available') {
            $room->status = 'booked';
            $room->save();

            Transaction::create($validatedData);

            Alert::success('Success', 'Room booked successfully.');
            return redirect()->route('pages.home');
        } else {
            return redirect()->back()->with('error', 'The selected room is not available.');
        }
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            "transaction_id" => "required"
        ], [
            "transcation_id.required" => "ID transaksi harus ada."
        ]);

        $transaction = Transaction::findOrFail($validatedData["transaction_id"]);

        $transaction->status = 'canceled';

        if ($transaction->status === 'expired' || $transaction->status === 'canceled') {
            $room = Room::findOrFail($transaction->room_id);
            $room->status = 'available';
            $room->save();
        }
        $transaction->save();
        Alert::success('Success', 'Membatalkan pemesanan.');
        return redirect()->route('booking.list');
    }

    public function list()
    {
        $transactions = auth()->user()->transactions;
        return view('pages.home.booking-list', [
            'title' => "History List",
            'transactions' => $transactions
        ]);
    }
}
