<?php

namespace App;

use App\Product;



class Seller extends User
{
    public function products()
    {
        return $this->hasMeny(Product::class);
    }
}
