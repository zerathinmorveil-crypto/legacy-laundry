<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Halaman utama customer setelah login
    public function index()
    {
        $user       = Auth::user();
        $customerId = $this->getCustomerId();

        $recentTransactions = Transaction::where('customer_id', $customerId)
            ->with('service')
            ->latest()
            ->take(5)
            ->get();

        $totalTransaksi = Transaction::where('customer_id', $customerId)->count();
        $totalSelesai   = Transaction::where('customer_id', $customerId)->where('status', 'selesai')->count();
        $totalProses    = Transaction::where('customer_id', $customerId)
                            ->whereIn('status', ['pending', 'dikonfirmasi', 'proses'])
                            ->count();

        return view('customers.home', compact(
            'user', 'recentTransactions',
            'totalTransaksi', 'totalSelesai', 'totalProses'
        ));
    }

    // Riwayat transaksi customer
    public function transactions()
    {
        $customerId   = $this->getCustomerId();
        $transactions = Transaction::where('customer_id', $customerId)
            ->with('service')
            ->latest()
            ->paginate(10);

        return view('customers.transactions', compact('transactions'));
    }

    // Profil customer
    public function profile()
    {
        return view('customers.profile', ['user' => Auth::user()]);
    }

    private function getCustomerId(): int|null
    {
        $customer = Customer::where('email', Auth::user()->email)->first();
        return $customer?->id ?? Auth::id();
    }
}