<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function getProducts($category): array
    {
        $res = [];
        foreach (self::query()->where('category_id', '=', $category)->with("product")->get()->all() as $item) {
            $res[] = $item->product;
        }
        return $res;
    }
}
