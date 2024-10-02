<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function get_supplier(){
        //get all suppliers
        $sql = $this->select("suppliers.*");

        return $sql;
    }

    /**
     * fillable
     * 
     * @var array
     */

    protected $fillable = [
        'supplier_name',
        'pic_supplier',
        'alamat_supplier',
        'no_hp_pic_supplier'
    ];
}
