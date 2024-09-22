<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function get_transaction(){
        //get all transaksi penjualan
        $sql = $this->select("transactions.*", "category_product.product_category_name as kategori_produk", "products.title as nama_produk", "products.price as harga",
                        Transaction::raw('jumlah_pembelian * products.price as total_harga'))
                    ->join('category_product', 'category_product.id', '=', 'transactions.product_category_id')
                    ->join('products', 'products.id', '=', 'transactions.product_id');
        return $sql;
    }
}
