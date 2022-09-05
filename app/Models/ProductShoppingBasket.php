<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShoppingBasket extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'shopping_basket_id',
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function getProducts($cart_id): array
    {
        $res = [];
        foreach (self::query()->where('shopping_basket_id', '=', $cart_id)->with('product')->get()->all() as $item) {
            $res[] = $item;
        }
        return $res;
    }

    public static function makeOrder($cart_id) {
        $products = self::getProducts($cart_id);
        self::query()->where('shopping_basket_id', '=', $cart_id)->delete();
        return $products;
    }

    public static function add($product_id, $cart): string
    {
        $product = Product::query()->where('id', '=', $product_id)->get()->all()[0];
        if ($product->num > 0) {
            $product->num -= 1;
            $product->save();
            self::create([
                'product_id' => $product_id,
                'shopping_basket_id' => $cart
            ]);
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function removeProducts(mixed $pid, mixed $count)
    {
        if ($count > 0) {
            Product::increaseNum($pid, $count);
            return self::query()->where('product_id', '=', $pid)->limit($count)->delete() > 0;
        }
        else {
            $res = self::query()->where('product_id', '=', $pid)->delete();
            Product::increaseNum($pid, $res);
            return true;
        }
    }
}
