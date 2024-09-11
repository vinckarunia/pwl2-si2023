<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function get_product(){
        //get all products
        $sql = $this->select("products.*", "category_product.product_category_name as product_category_name")
                    ->join('category_product', 'category_product.id', '=', 'products.product_category_id');

        return $sql;
    }
}
