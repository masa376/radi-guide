<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    // examinations との1対多のリレーション
    public function examinations()
    {
        return $this->hasMany(Examination::class)->orderBy('order');
    }
}
