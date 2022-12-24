<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('title', 'like', $term)
                ->orWhere('body', 'like', $term);
        })->orWhereHas('category', function ($query) use ($term) {
            $query->where('name', 'like', $term);
        })->orWhereHas('user', function ($query) use ($term) {
            $query->where('name', 'like', $term);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function getThumbnailAttribute()
    // {
    //     return asset('/storage/' . $this->attributes['thumbnail']);
    // }
}
