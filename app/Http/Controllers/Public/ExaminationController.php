<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Examination;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    // 一覧・検索
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');

        $query = Examination::published()->with('category');

        // キーワード検索
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // カテゴリ絞り込み
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $examinations = $query->orderBy('order')->paginate(9);
        $categories   = Category::orderBy('order')->get();

        return view('public.examinations.index', compact(
            'examinations',
            'categories',
            'keyword',
            'categoryId',
        ));
    }

    // 詳細
    public function show(string $slug)
    {
        $examination = Examination::published()
                                ->with(['category', 'checklists', 'faqs'])
                                ->where('slug', $slug)
                                ->firstOrFail();

        return view('public.examinations.show', compact('examination'));
    }
}
