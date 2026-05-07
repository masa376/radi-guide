<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\Category;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    // 一覧
    public function index()
    {
        $examinations = Examination::with('category')
                                    ->orderBy('order')
                                    ->paginate(10);
        return view('admin.examinations.index', compact('examinations'));
    }

    // 作成画面
    public function create()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.examinations.create', compact('categories'));
    }

    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:examinations,slug|regex:/^[a-z0-9-]+$/',
            'description'  => 'required|string',
            'purpose'      => 'nullable|string',
            'procedure'    => 'nullable|string',
            'duration'     => 'nullable|integer|min:1',
            'precautions'  => 'nullable|string',
            'is_published' => 'boolean',
            'order'        => 'required|integer|min:0',
        ]);

        Examination::create([
            ...$request->only([
                'category_id',
                'title',
                'slug',
                'description',
                'purpose',
                'procedure',
                'duration',
                'precautions',
                'order',
            ]),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.examinations.index')
            ->with('success', '検査記事を登録しました');
    }

    // 詳細
    public function show(Examination $examination)
    {
        return view('admin.examinations.show', compact('examination'));
    }

    // 編集画面
    public function edit(Examination $examination)
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.examinations.edit', compact('examination', 'categories'));
    }

    // 更新
    public function update(Request $request, Examination $examination)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:examinations,slug,' . $examination->id .'|regex:/^[a-z0-9-]+$/',
            'description'  => 'required|string',
            'purpose'      => 'nullable|string',
            'procedure'    => 'nullable|string',
            'duration'     => 'nullable|integer|min:1',
            'precautions'  => 'nullable|string',
            'is_published' => 'boolean',
            'order'        => 'required|integer|min:0',
        ]);

        $examination->update([
            ...$request->only([
                'category_id',
                'title',
                'slug',
                'description',
                'purpose',
                'procedure',
                'duration',
                'precautions',
                'order',
            ]),
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.examinations.index')
            ->with('success', '検査記事を更新しました');
    }

    // 削除
    public function destroy(Examination $examination)
    {
        $examination->delete();
        return redirect()->route('admin.examinations.index')
            ->with('success', '検査記事を削除しました');
    }
}
