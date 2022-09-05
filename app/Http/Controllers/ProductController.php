<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOrder;
use App\Models\ProductShoppingBasket;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll(Request $request) {
        return Product::getAll();
    }

    public function getOne(Request $request) {
        return Product::getOne($request->all()['pid']);
    }

    public function getByCategory(Request $request): array
    {
        return ProductCategory::getProducts($request->all()['cid']);
    }

    public function removeProduct(Request $request) {
        if ($request->user()->id != 1) {
            return 'error. forbidden';
        }
        try {
            $pid = $request->all()['pid'];
            ProductCategory::query()->where('product_id', '=', $pid)->delete();
            ProductShoppingBasket::query()->where('product_id', '=', $pid)->delete();
            ProductOrder::query()->where('product_id', '=', $pid)->delete();
            return Product::query()->where('id', '=', $pid)->delete();
        } catch (\Exception $err) {
            return 'failed';
        }
    }

    public function updateProduct(Request $request): int | string
    {
//        if ($request->user()->id != 1) {
//            return 'error. forbidden';
//        }
        $data = $request->all();
        return Product::query()->where('id', '=', $data['id'])->update($data);
    }


}
