<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAll(Request $request): array
    {
        return Category::getAll();
    }

    public function create(Request $request) {
        return Category::createNew($request->all());
    }

    public function remove(Request $request) {
        $id = $request->all()['cid'];
        return Category::query()->where('id', '=', $id)->delete();
    }
}
