<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingCount = Transaction::where('status', 'pending')
            ->where('sumber', 'customer')
            ->count();

        return view('dashboard', compact('pendingCount'));
    }
}