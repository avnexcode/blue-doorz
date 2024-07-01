<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\TransactionUpdateRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('user', 'room')->filter(request()->only('search'))->paginate(10);
        return view('pages.dashboard.transaction.index', [
            "title" => "Dashboard Transaction",
            "transactions" => TransactionResource::collection($transactions)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('pages.dashboard.transaction.detail', [
            "title" => "Detail Transaction",
            "transaction" => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view("pages.dashboard.transaction.edit", [
            "title" => "Transaction Update",
            "transaction" => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        $validatedData = $request->validated();
        $transaction->status = $validatedData["status"];

        if ($validatedData['status'] === 'expired' || $validatedData['status'] === 'canceled') {
            $room = Room::findOrFail($validatedData['room_id']);
            $room->status = 'available';
            $room->save();
        }

        $transaction->save();
        Alert::success('Success', 'Memperbarui status transaksi.');
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $room = Room::findOrFail($transaction['room_id']);
        $room->status = 'available';
        $room->save();
        $transaction->delete();
        Alert::success('Berhasil', 'Menghapus data.');
        return redirect()->route('transactions.index');
    }
}
