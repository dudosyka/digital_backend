<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function getProducts($order_id) {
        return self::query()->where('order_id', '=', $order_id)->with('product')->get()->all();
    }

    public static function addFromCart($order_id, $cart_id) {
        $products = ProductShoppingBasket::makeOrder($cart_id);
        $ids = [];
        foreach ($products as $product) {
            self::create([
                'product_id' => $product->product->id,
                'order_id' => $order_id
            ]);
        }
        return count($products) > 0;
    }
}
