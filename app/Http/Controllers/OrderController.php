<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request) {
        return Order::createNew($request->user()->id);
    }

    public function getOrders(Request $request) {
        if (isset($request->all()['uid']))
            return Order::getOrders($request->all()['uid']);
        else
            return Order::getOrders($request->user()->id);
    }

    public function getOrder(Request $request) {
        return Order::getOrder($request->all()['oid']);
    }

    public function remove(Request $request) {
        return Order:remove($request->all()['order_id']);
    }
}
