<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 一覧
    public function index()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // 作成時間
    public function create()
    {
        return view('admin.categories.create');
    }

    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:categories,slug|regex:/^[a-z0-9-]+$/',
            'order' => 'required|integer|min:0',
        ]);

        Category::create($request->only(['name', 'slug', 'order']));

        return redirect()->route('admin.categories.index')
            ->with('success', 'カテゴリを登録しました');
    }

    // 詳細
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    // 編集画面
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // 更新
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:categories,slug,' . $category->id . '|regex:/^[a-z0-9-]+$/',
            'order' => 'required|integer|min:0',
        ]);

        $category->update($request->only(['name', 'slug', 'order']));

        return redirect()->route('admin.categories.index')
            ->with('success', 'カテゴリを更新しました');
    }

    // 削除
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'カテゴリを削除しました');
    }
}
