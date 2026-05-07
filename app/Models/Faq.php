<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'examination_id',
        'question',
        'answer',
        'order',
    ];

    // examination との多対1のリレーション
    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

    // 全般FAQのみ取得するスコープ
    public function scopeGeneral($query)
    {
        return $query->whereNull('examination_id');
    }
}