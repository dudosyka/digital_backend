<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static function createNew($data) {
        return self::create($data);
    }

    public static function getAll() {
        return self::query()->where('id', '!=', 0)->get();
    }

    public static function getOne($id) {
        return self::query()->where('id', '=', $id)->get();
    }

    public static function getNum($id) {
        return Product::query()->where('id', '=', $id)->get()->all()[0]->num;
    }

    public static function increaseNum($id, $num) {
        $product = self::getOne($id)->all()[0];
        $product->num += $num;
        $product->save();
    }

    public static function addToCart($id, $userId) {
        if (self::getNum($id) <= 0) {
            return false;
        }
        $item = ShoppingBasket::query()->create();
        UserShoppingBasket::query()->create(['user_id' => $userId, 'shopping_basket_id' => $item]);
        ProductShoppingBasket::query()->create(['product_id' => $id, 'shopping_basket_id' => $item]);
        Product::query()->where('id', '=', $id)->update(['num' => self::getNum($id) - 1]);
        return true;
    }

    public static function removeFromCart($id, $userId) {
        $item = UserShoppingBasket::getByUser($userId);
        Product::query()->where('id', '=', $id)->update(['num' => self::getNum($id) + 1]);
        return ProductShoppingBasket::query()->where('product_id', '=', $id)->where('shopping_basket_id', '=', $item);
    }

    public static function getByCategory($categoryId) {
//        return self::query()->where
    }

}
