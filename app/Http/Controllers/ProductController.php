<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
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
}
