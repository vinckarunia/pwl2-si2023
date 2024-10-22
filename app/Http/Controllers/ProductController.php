<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() : view
    {
        //get all products
        // $products = Product::select("products.*", "category_product.product_category_name as product_category_name")
        //                      ->join('category_product', 'category_product.id', '=', 'products.product_category_id')
        //                      ->latest()
        //                      ->paginate(10);

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
     * @return view
     */
    public function create(): view{
        $product = new Product;
        $supplier = new Supplier;

        $data['categories'] = $product->get_category_product()->get();
        $data['suppliers'] = $supplier->get_supplier()->get();

        return view('products.create', compact('data'));
    }

    /**\
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     */

     public function store(Request $request): RedirectResponse{
        $validateData = $request -> validate([
            'image'                 => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'                 => 'required|min:5',
            'product_category_id'   => 'required|integer',
            'supplier_id'           => 'required|integer',
            'description'           => 'required|min:10',
            'price'                 => 'required|numeric',
            'stock'                 => 'required|numeric',
        ]);

        //Menghandle upload file gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images');

            Product::create([
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'product_category_id'   => $request->product_category_id,
                'supplier_id'           => $request->supplier_id,
                'description'           => $request->description,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
            ]);
        
            // Redirect to the index route with a success message
            return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }        

        //also redirect to index even when failed
        return redirect()->route('products.index')->with(['error'=>'Data Berhasil Disimpan!']);
     }


     /**
      * show 
      *
      * @param mixed $id
      * @return View
      */
      public function show(string $id): View 
      {

        //get data by ID
        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        return view('products.show', compact('product'));
      }

      /**
       * edit
       * 
       * @param mixed $id
       * @return View
       */

       public function edit(string $id): View
       {
        $product_model = new Product;
        $data['product'] = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        $supplier_model = new Supplier;

        $data['categories'] = $product_model->get_category_product()->get();
        $data['suppliers'] = $supplier_model->get_supplier()->get();

        return view('products.edit', compact('data'));
       }

       /**
         * update
         * 
         * @param  mixed $request
         * @param  mixed $id
         * @return RedirectResponse
         */
        public function update(Request $request, $id): RedirectResponse
        {
            //validate form
            $request->validate([
                'image'       => 'image|mimes:jpeg,jpg,png|max:2048',
                'title'       => 'required|min:5',
                'description' => 'required|min:10',
                'price'       => 'required|numeric',
                'stock'       => 'required|numeric',
            ]);

            //get product by ID
            $product_model = new Product;
            $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

            if ($request->hasFile('image')) {

                //upload new image
                $image = $request->file('image');
                $image->storeAs('public/images', $image->hashName());
            
                //delete old image
                Storage::delete('public/images/' . $product->image);
            
                //update product with new image
                $product->update([
                    'image'                 => $image->hashName(),
                    'title'                 => $request->title,
                    'product_category_id'   => $request->product_category_id,
                    'supplier_id'           => $request->supplier_id,
                    'description'           => $request->description,
                    'price'                 => $request->price,
                    'stock'                 => $request->stock,
                ]);        
        } else {

            $product->update([
                    'title'                 => $request->title,
                    'product_category_id'   => $request->product_category_id,
                    'supplier_id'           => $request->supplier_id,
                    'description'           => $request->description,
                    'price'                 => $request->price,
                    'stock'                 => $request->stock,
            ]);

        }

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah']);

    }

    /**
     * destroy
     * 
     * @param mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        // Delete image associated with the product
        Storage::delete('public/images/'. $product->image);

        // Delete the product
        $product->delete(); // Correct variable here

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus']); // Correct 'success' spelling
    }
}