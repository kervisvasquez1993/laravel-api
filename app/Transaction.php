<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $date = ['deleted_at'];
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id'
    ];
    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
