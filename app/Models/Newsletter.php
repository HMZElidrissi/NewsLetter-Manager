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

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }
}
