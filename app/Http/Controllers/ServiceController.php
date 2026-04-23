<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('service.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_service' => 'required|string|max:255|unique:services',
            'harga_per_kg' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service berhasil ditambahkan!');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nama_service' => 'required|string|max:255|unique:services,nama_service,' . $service->id,
            'harga_per_kg' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')
            ->with('success', 'Service berhasil diupdate!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')
            ->with('success', 'Service berhasil dihapus!');
    }
}