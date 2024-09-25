<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

    public function index() : View
    {
        //get all products
        // $products = Product::select("products.*", "category_product.product_category_name as product_category_name", "suppliers.supplier_name as supplier_name")
        //                     ->join('category_product', 'category_product.id', '=', 'products.product_category_id')
        //                     ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
        //                     ->latest()
        //                     ->paginate(10);

        $product = new Product;
        $products = $product->get_product()
                            ->latest()
                            ->paginate(10);
        //render view with products
        return view('products.index', compact('products'));
    }

    /**
     * create
     * 
     * @return View
     */

    public function create():View
    {
        $product = new Product;
        $supplier = new Supplier;
        
        $data['categories'] = $product->get_category_product()->get();
        $data['suppliers'] = $supplier->get_supplier()->get();

        return view('products.create', compact('data'));
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     */

    public function store(Request $request):RedirectResponse
    {
        // var_dump($request);

        //validate from
        $validatedData = $request->validate([
            'image'                 => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'                 => 'required|min:5',
            'product_category_id'   => 'required|integer',
            'id_supplier'           => 'required|integer',
            'description'           => 'required|min:10',
            'price'                 => 'required|numeric',
            'stock'                 => 'required|numeric'
        ]);
        // var_dump($validatedData);exit;
        //handle upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images'); //tempat menyimpan file upload

            //create Product
            Product::create([
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'product_category_id'   => $request->product_category_id,
                'supplier_id'           => $request->id_supplier,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
            ]);

            //redirect to index
            return redirect()->route('products.index')->with(['success' => 'Data berhasil disimpan!']);
        }
        
        //redirect to index
        return redirect()->route('products.index')->with(['error' => 'Gagal mengupload gambar.']);
    }
}   