<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public function get_product(){
        //get all products
        $sql = $this->select("products.*", "category_product.product_category_name as product_category_name", "suppliers.supplier_name as supplier_name")
                    ->join('category_product', 'category_product.id', '=', 'products.product_category_id')
                    ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
                    ->orderBy('product_category_name', 'asc');
        return $sql;
    }

    public function get_category_product(){
        //get all categories
        $sql = DB::table('category_product')->select('*');

        return $sql;
    }

    /**
     * fillable
     * 
     * @var array
     */

    protected $fillable = [
        'image',
        'title',
        'product_category_id',
        'supplier_id',
        'description',
        'price',
        'stock'
    ];
}
