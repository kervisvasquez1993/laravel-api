<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    const PRODUCTO_DISPONIBLE = 'DISPONIBLE';
    const PRODUCTO_NO_DISPONIBLE = 'NO DISPONIBLE';
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'imagen',
        'seller_id'
    ];

    public function estaDisponible()
    {
        return $this->status == Product::PRODUCTO_DISPONIBLE;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function seller()
    {
        return  $this->belongsTo(Seller::class, 'seller_id');
    } 

    public function transactions()
    {
        return $this->hasMeny(Transaction::class);
    }

}
