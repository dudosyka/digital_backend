<?php

namespace App\Http\Controllers;

use App\Models\ProductShoppingBasket;
use App\Models\ShoppingBasket;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Request $request) {
        return ShoppingBasket::addProduct($request->user()->id, $request->all()['pid']);
    }

    public function removeProducts(Request $request) {
        return ProductShoppingBasket::removeProducts($request->all()['pid'], $request->all()['count']);
    }
}
