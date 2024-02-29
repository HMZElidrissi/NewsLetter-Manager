<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    protected $failable = [
        'content',
        'category_id',
        'mail_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected $fillable = [
        'title',
        'subheader',
        'content',
        'image',
        'category_id',
    ];
}
