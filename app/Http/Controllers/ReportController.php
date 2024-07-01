<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportCreateRequest;
use App\Http\Resources\ReportResource;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::filter(request()->only('search'))->paginate(10);
        return view("pages.dashboard.report.index", [
            "title" => "Dashboard Report",
            "reports" => ReportResource::collection($reports),
            "transactions" => Transaction::get()
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
    public function store(ReportCreateRequest $request)
    {
        $validatedData = $request->validated();

        $existingTransactionIds = Report::pluck('transaction_ids')->map(function ($item) {
            return json_decode($item, true);
        })->flatten()->toArray();

        $newTransactionIds = $validatedData['transaction_ids'];

        $uniqueTransactionIds = array_diff($newTransactionIds, $existingTransactionIds);

        if (empty($uniqueTransactionIds)) {
            Alert::info('Peringatan', 'Semua data sudah ada dalam laporan sebelumnya.');
            return redirect()->route('reports.index');
        }

        $reportData = [
            'transaction_ids' => json_encode($uniqueTransactionIds),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Report::create($reportData);

        Alert::success('Berhasil', 'Membuat Laporan Baru');
        return redirect()->route('reports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        $transactionIds = json_decode($report->transaction_ids, true);
        $transactions = Transaction::findMany($transactionIds);

        return view('pages.dashboard.report.detail', [
            "title" => "Dashboard Print",
            "transactions" => $transactions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $transactionIds = json_decode($report->transaction_ids, true);

        foreach ($transactionIds as $transactionId) {
            $transaction = Transaction::findOrFail($transactionId);

            $room = $transaction->room;
            $room->update(['status' => 'available']);
            $transaction->delete();
        }
        Alert::success('Berhasil', 'Menghapus Laporan');

        $report->delete();

        return redirect()->route('reports.index');
    }
}
