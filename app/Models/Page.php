<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content', 
        'image_path', 
        'status', 
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
