<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $products = [];

    protected $fillable = [
        'status'
    ];

    public static function createNew($user_id) {
        $cart_id = UserShoppingBasket::getByUser($user_id);
        $order = self::create([
            'status' => 'new'
        ]);
        $user_order = UserOrder::createNew($user_id, $order->id);
        if (ProductOrder::addFromCart($order->id, $cart_id) === false) {
            $user_order->delete();
            $order->delete();
            return false;
        }
        return $order->id;
    }

    public static function getOrders($user_id = 0) {
        if ($user_id != 0) {
            $res = [];
            foreach (UserOrder::getOrders($user_id) as $order) {
                $data = self::query()->where('id', '=', $order->order_id)->get()->all()[0]->attributes;
                $data['products'] = ProductOrder::getProducts($order->order_id);
                $res[] = $data;
            }
            return $res;
        }
        $res = [];
        foreach (UserOrder::query()->where('id', '!=', '0')->get()->all() as $order) {
            $data = self::query()->where('id', '=', $order->order_id)->get()->all()[0];
            $data->products = ProductOrder::getProducts($order->order_id);
            $res[] = $data;
        }
        return $res;
    }

    public static function getOrder(mixed $oid)
    {
        $data = self::query()->where('id', '=', $oid)->get()->all();
        if (count($data)) {
            $data = $data[0]->attributes;
            $data['products'] = ProductOrder::getProducts($oid);
            return $data;
        }
        return [];
    }
}
