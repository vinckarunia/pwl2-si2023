<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers'; 
    
    protected $fillable = [
        'nama_supplier',
        'alamat_supplier',
        'pic_supplier',
        'no_hp_pic_supplier',
    ]; 

    
    public function get_supplier()
    {
        return $this->select("suppliers.*"); 
    }
}