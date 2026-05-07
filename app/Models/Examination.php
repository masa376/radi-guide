<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'purpose',
        'procedure',
        'duration',
        'precautions',
        'is_published',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // category との多対1のリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // checklists との1対多のリレーション
    public function checklists()
    {
        return $this->hasMany(Checklist::class)->orderBy('order');
    }

    // faqs との1対多のリレーション
    public function faqs()
    {
        return $this->hasMany(Faq::class)->orderBy('order');
    }

    // 公開済みのみ取得するスコープ
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
