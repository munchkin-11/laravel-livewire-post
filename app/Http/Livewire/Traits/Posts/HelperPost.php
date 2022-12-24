<?php

namespace App\Http\Livewire\Traits\Posts;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


trait HelperPost
{
    public static $modelName = Post::class;
    public static $strHelper = Str::class;
    public static $categoryModel = Category::class;
    public static $storageHelper = Storage::class;

    public function model()
    {
        return new self::$modelName;
    }

    public function categoryModel()
    {
        return new self::$categoryModel;
    }

    public function strHelper()
    {
        return new self::$strHelper;
    }

    public function storageHelper()
    {
        return new self::$storageHelper;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectItem = $this->model()->pluck('id');
        } else {
            $this->selectItem = [];
        }
    }
}
