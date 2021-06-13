<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Seller;
use Illuminate\Http\Request;

class SellerBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $buyer = $seller->products()
        ->whereHas('transactions')
        ->with('transactions.buyer')
        ->get()
        ->pluck('transactions') // traemos las transaciones los cuales nos dara una serie de collepsiones independiente
        ->collapse()
        ->pluck('buyer') //
        ->unique()
        ->values();

        return $buyer;
    }

 
}
