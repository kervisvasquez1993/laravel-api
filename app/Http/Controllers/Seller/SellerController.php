<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedor = Seller::has('products')->get();
        return $this->showAll($vendedor);
    }

    
    
    public function show(Seller $seller)
    {
        /* $vendedor = Seller::has('products')->findOrFail($id);
        return $this->showOne($vendedor); */

        return $this->showOne($seller);
    }

  
}
