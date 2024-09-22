<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;

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
}   