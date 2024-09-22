<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransaksiPenjualan;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

    public function index() : View
    {
        //get all transactions
        // $transactions = Transaction::select("transactions.*", "category_product.product_category_name as kategori_produk", "products.title as nama_produk", "products.price as harga", Transaction::raw('jumlah_pembelian * products.price as total_harga'))
        //                     ->join('category_product', 'category_product.id', '=', 'transactions.product_category_id')
        //                     ->join('products', 'products.id', '=', 'transactions.product_id')
        //                     ->latest()
        //                     ->paginate(10);

        $transaction = new Transaction();
        $transactions = $transaction->get_transaction()
                            ->latest()
                            ->paginate(10);
        //render view with transactions
        return view('transactions.index', compact('transactions'));
    }
}   