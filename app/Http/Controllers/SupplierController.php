<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
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
            'supplier_name'         => 'required|min:5',
            'pic_supplier'          => 'required|min:5',
            'alamat_supplier'       => 'required|min:5',
            'no_hp_pic_supplier'    => 'required|min:10|max:13',
        ]);
 
        //handle upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images'); //tempat menyimpan file upload
 
            //create Product
            Supplier::create([
                'supplier_name'         => $request->supplier_name,
                'pic_supplier'          => $request->pic_supplier,
                'alamat_supplier'       => $request->alamat_supplier,
                'no_hp_pic_supplier'    => $request->no_hp_pic_supplier,
            ]);
 
            //redirect to index
            return redirect()->route('suppliers.index')->with(['success' => 'Data berhasil disimpan!']);
        }
        
        //redirect to index
        return redirect()->route('suppliers.index')->with(['error' => 'Gagal mengupload gambar.']);
     }
}   