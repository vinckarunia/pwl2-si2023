<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SupplierController extends Controller
{
    public function index(): View
    {
        $supplier = new Supplier;
        $suppliers = $supplier->get_supplier()->latest()->paginate(10);

        return view('suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        $supplier = new Supplier;
        $suppliers = $supplier->get_supplier()->get();

        return view('suppliers.create', compact('suppliers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_supplier'         => 'required|min:5',
            'alamat_supplier'       => 'required|min:5',
            'pic_supplier'          => 'required|min:5',
            'no_hp_pic_supplier'    => 'required|min:1|max:30',
        ]);

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id): View
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.show', compact('supplier'));
    }

    public function edit(string $id): View
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_supplier'         => 'required|min:5',
            'alamat_supplier'       => 'required|min:5',
            'pic_supplier'          => 'required|min:5',
            'no_hp_pic_supplier'    => 'required|min:10|max:13',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Data Berhasil Diubah!');
    }

    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
