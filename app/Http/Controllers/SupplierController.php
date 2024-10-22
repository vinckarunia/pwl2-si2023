<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SupplierController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

    public function index() : View
    {
        //get all suppliers
        // $suppliers = Supplier::select("suppliers.*")
        //                     ->latest()
        //                     ->paginate(10);

        $supplier = new Supplier;
        $suppliers = $supplier->get_supplier()
                            ->latest()
                            ->paginate(10);
        //render view with suppliers
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * create
     * 
     * @return View
     */

    public function create():View
    {
        $supplier = new Supplier;
        
        $data['suppliers'] = $supplier->get_supplier()->get();
 
        return view('suppliers.create', compact('data'));
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     */

    public function store(Request $request):RedirectResponse
    {
        //validate from
        $validatedData = $request->validate([
            'nama_supplier'         => 'required|min:5',
            'alamat_supplier'       => 'required|min:5',
            'pic_supplier'          => 'required|min:5',
            'no_hp_pic_supplier'    => 'required|min:1|max:30',
        ]);

            //create Product
        Supplier::create([
            'nama_supplier'         => $request->nama_supplier,
            'alamat_supplier'       => $request->alamat_supplier,
            'pic_supplier'          => $request->pic_supplier,
            'no_hp_pic_supplier'    => $request->no_hp_pic_supplier,
        ]);
 
        return redirect()->route('suppliers.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Show
     *
     * @param string $id
     * @return View
     */
    public function show(string $id): View 
    {
        // Get supplier data by ID
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * edit
     * 
     * @param mixed $id
     * @return View
     */

    public function edit(string $id): View
    {
        //get product by id
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }
 
    /**
      * update
      * 
      * @param mixed $request
      * @param mixed $id
      * @return RedirectResponse
      */
 
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'nama_supplier'         => 'required|min:5',
            'alamat_supplier'       => 'required|min:5',
            'pic_supplier'          => 'required|min:5',
            'no_hp_pic_supplier'    => 'required|min:10|max:13',
        ]);
 
        //get product by id
        $supplier = Supplier::findOrFail($id);
 
            $supplier->update([
                'nama_supplier'         => $request->nama_supplier,
                'alamat_supplier'       => $request->alamat_supplier,
                'pic_supplier'          => $request->pic_supplier,
                'no_hp_pic_supplier'    => $request->no_hp_pic_supplier,
            ]);

            return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Diubah!']);
        }


    /**
     * 
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.show')->with('success', 'Supplier deleted successfully.');
    }
}