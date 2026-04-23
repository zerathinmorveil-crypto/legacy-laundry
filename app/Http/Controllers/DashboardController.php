<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total transaksi selesai
        $totalTransaksi = Transaction::where('status', 'selesai')->count();

        // Sedang diproses
        $proses = Transaction::where('status', 'proses')->count();

        // Total customer
        $totalCustomer = Customer::count();

        // Pendapatan bulan ini
        $pendapatan = Transaction::where('status', 'selesai')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('sub_total'); // pastikan field ini ada

        $transaksiAktif = Transaction::with(['customer', 'service'])
            ->whereIn('status', ['pending', 'proses'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalTransaksi',
            'proses',
            'totalCustomer',
            'pendapatan'
        ));

        $labels = [];
        $data = [];
    
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
    
            $labels[] = $tanggal->format('d M');
    
            $total = Transaction::where('status', 'selesai')
                ->whereDate('created_at', $tanggal)
                ->sum('sub_total');
    
            $data[] = $total;
        }
    
        return view('dashboard', compact(
            'totalTransaksi',
            'proses',
            'totalCustomer',
            'pendapatan',
            'transaksiAktif',
            'labels',
            'data'
        ));
    }
}
