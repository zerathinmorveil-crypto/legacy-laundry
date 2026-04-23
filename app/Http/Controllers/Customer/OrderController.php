<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // ← Method ini yang hilang sebelumnya, wajib ada
    private function getCustomer(): Customer
{
    return Customer::firstOrCreate(
        ['email' => Auth::user()->email],
        [
            'nama'   => Auth::user()->name,
            'no_hp'  => '-',
            'alamat' => '-',
        ]
    );
}

    public function create()
    {
        $services = Service::where('status', 'aktif')->get();
        return view('customers.order.create', compact('services'));
    }

    public function store(Request $request)
{
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'berat'      => 'required|numeric|min:1',
        'catatan'    => 'nullable|string|max:500',
    ]);

    $service  = Service::findOrFail($request->service_id);
    $customer = $this->getCustomer();

    $totalHarga = $service->harga_per_kg * $request->berat;

    Transaction::create([
        'kode_transaksi'   => Transaction::generateKode(),
        'customer_id'      => $customer->id,
        'service_id'       => $request->service_id,
        'berat'            => $request->berat,
        'tanggal_masuk'    => now()->toDateString(),
        'sub_total'        => $totalHarga,
        'total'            => $totalHarga,
        // HAPUS BARIS INI: 'total_harga'      => $totalHarga,
        'diskon'           => 0,
        'status'           => 'pending',
        'status_bayar'     => 'belum',
        'sumber'           => 'customer',
        'catatan'          => $request->catatan,
    ]);

    return redirect()->route('customer.transactions')
                     ->with('success', 'Pesanan berhasil dikirim! Menunggu konfirmasi kasir.');
}

    public function cancel(Transaction $transaction)
    {
        $customer = $this->getCustomer();

        if ($transaction->customer_id !== $customer->id) {
            abort(403, 'Akses ditolak.');
        }

        if ($transaction->status !== 'pending') {
            return redirect()->back()
                             ->with('error', 'Pesanan tidak bisa dibatalkan karena sudah diproses.');
        }

        $transaction->delete();

        return redirect()->route('customer.transactions')
                         ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}