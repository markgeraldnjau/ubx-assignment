<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //

    public function viewPurchase()
    {

        // return Auth::id();
        $pricelists = PriceList::all();

        return view('purchases.purchases')
            ->with('pricelists', $pricelists);
    }
}
