<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public static function getAll(): array
    {
        return Category::query()->where('id', '!=', '0')->get()->all();
    }

    public static function createNew($data) {
        return Category::create($data);
    }
}
