<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with(['customer', 'service'])
            ->when($request->search, function ($query, $search) {
                return $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('kode_transaksi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        $pendingCount = Transaction::where('status', 'pending')
            ->where('sumber', 'customer')
            ->count();

        $customers = Customer::all();
        $services = Service::all();

        return view('transactions.index', compact(
            'transactions',
            'customers',
            'services',
            'pendingCount'
        ));
    }

    public function struk(Transaction $transaction)
    {
        $transaction->load(['customer', 'service']);
        return view('transactions.struk', compact('transaction'));
    }

    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('transactions.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'berat' => 'required|numeric|min:0.1',
            'tanggal_masuk' => 'required|date',
            'tanggal_ambil' => 'nullable|date|after_or_equal:tanggal_masuk',
            'status' => 'nullable|in:pending,dikonfirmasi,proses,selesai,diambil,baru',
            'status_bayar' => 'nullable|in:lunas,belum',
            'jenis_pembayaran' => 'nullable|string|max:50',
        ]);
    
        $service = Service::findOrFail($request->service_id);
        $customer = Customer::findOrFail($request->customer_id);
    
        $sub_total = $request->berat * $service->harga_per_kg;
        $diskon = $customer->diskon ?? 0;
        $total = $sub_total - ($sub_total * $diskon / 100);
    
        // ✅ TAMBAHKAN KODE TRANSAKSI & SEMUA FIELD YANG WAJIB
        Transaction::create([
            'kode_transaksi' => Transaction::generateKode(), // ✅ INI YANG HILANG!
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'berat' => $request->berat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_ambil' => $request->tanggal_ambil,
            'sub_total' => $sub_total,
            'diskon' => $diskon,
            'total' => $total,
            'status' => $request->status ?? 'pending', // ✅ default 'pending'
            'jenis_pembayaran' => $request->jenis_pembayaran ?? 'tunai',
            'status_bayar' => $request->status_bayar ?? 'belum',
            'sumber' => 'kasir', // ✅ sesuai enum
        ]);
    
        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }
    
    public function show(Transaction $transaction)
    {
        $transaction->load(['customer', 'service']);
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('transactions.edit', compact('transaction', 'customers', 'services'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'berat' => 'required|numeric|min:0.1',
            'tanggal_masuk' => 'required|date',
            'tanggal_ambil' => 'nullable|date|after_or_equal:tanggal_masuk',
        ]);

        $service = Service::find($request->service_id);
        $customer = Customer::find($request->customer_id); // ✅ FIX

        $sub_total = $request->berat * $service->harga_per_kg;
        $diskon = $customer->diskon ?? 0;
        $total = $sub_total - ($sub_total * $diskon / 100);

        $transaction->update([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'berat' => $request->berat,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_ambil' => $request->tanggal_ambil,
            'sub_total' => $sub_total,
            'diskon' => $diskon,
            'total' => $total,
            'status' => $request->status ?? 'proses',
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'status_bayar' => $request->status_bayar ?? 'belum',
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diupdate!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,dikonfirmasi,proses,selesai,diambil',
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    public function myTransactions()
    {
        // Mengambil transaksi berdasarkan user_id yang ada di tabel customers
        $transactions = Transaction::whereHas('customer', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);
    
        return view('transactions.my', compact('transactions'));
    }

    public function dailyReport()
    {
        return view('reports.daily');
    }

    public function monthlyReport()
    {
        return view('reports.monthly');
    }
}