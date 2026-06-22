<?php

use App\Models\Category;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// カテゴリ一覧
Route::get('/categories', function () {
    return Category::orderBy('order')->get();
});

// 検索一覧・検索
Route::get('/examinations', function (Request $request) {
    $query = Examination::published()
                        ->with(['category'])
                        ->withCount('checklists')
                        ->orderBy('order');

    // キーワード検索
    if ($request->keyword) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', "%{$request->keyword}%")
            ->orWhere('description', 'like', "%{$request->keyword}%");
        });
    }

    // カテゴリ絞り込み
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    $examinations = $query->paginate(9);

    return response()->json([
        'data'  => $examinations->items(),
        'total' => $examinations->total(),
    ]);
});