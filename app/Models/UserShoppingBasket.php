<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShoppingBasket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shopping_basket_id',
        'created_at',
        'updated_at'
    ];

    public static function getByUser($userId) {
        $res = UserShoppingBasket::query()->where('user_id', '=', $userId)->get()->all();
        if (count($res))
            return $res[0]->shopping_basket_id;
        else
            return false;
    }

    public static function createNew($user_id, $cart)
    {
        return UserShoppingBasket::create([
            'user_id' => $user_id,
            'shopping_basket_id' => $cart,
        ]);
    }
}
