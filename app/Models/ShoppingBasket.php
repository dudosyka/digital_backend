<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingBasket extends Model
{
    use HasFactory;

    public static function addProduct($user_id, $product_id) {
        $exists = UserShoppingBasket::getByUser($user_id);
        if (!$exists) {
            $exists = self::create()->id;
            UserShoppingBasket::createNew($user_id, $exists);
        }
        return ProductShoppingBasket::add($product_id, $exists);
    }
}
