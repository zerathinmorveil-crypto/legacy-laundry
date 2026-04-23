<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Customer;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        $customers = Customer::where('status', 'aktif')->get(['id', 'nama', 'no_hp', 'email', 'alamat']);
        return view('members.create', compact('customers'));
    }

    public function getCustomerData(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        if ($customer) {
            return response()->json([
                'success' => true,
                'data' => $customer
            ]);
        }
        return response()->json(['success' => false]);
    }

     public function store(Request $request)
    {
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20|unique:members',
            'email' => 'nullable|email|unique:members',
            'alamat' => 'required|string',
            'jenis_member' => 'required|in:reguler,silver,gold,platinum',
            'diskon' => 'required|integer|min:0|max:50',
            'customer_id' => 'nullable|exists:customers,id'  // TAMBAHKAN
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')
            ->with('success', 'Member berhasil ditambahkan!');
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20|unique:members,no_hp,' . $member->id,
            'email' => 'nullable|email|unique:members,email,' . $member->id,
            'alamat' => 'required|string',
            'jenis_member' => 'required|in:reguler,silver,gold,platinum',
            'diskon' => 'required|integer|min:0|max:50',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')
            ->with('success', 'Member berhasil diupdate!');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')
            ->with('success', 'Member berhasil dihapus!');
    }
}