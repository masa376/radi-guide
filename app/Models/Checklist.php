<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'examination_id',
        'item',
        'is_required',
        'order',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    // examination との多対1のリレーション
    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
