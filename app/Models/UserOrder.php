<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id'
    ];

    public static function createNew($user_id, $order_id) {
        return self::create([
            'user_id' => $user_id,
            'order_id' => $order_id
        ]);
    }

    public static function getOrders($user_id) {
        return self::query()->where('user_id', '=', $user_id)->get()->all();
    }
}
