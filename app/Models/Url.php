<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'original_url',
        'short_url',
        'is_disabled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
