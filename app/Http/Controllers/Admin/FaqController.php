<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Examination;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // 一覧
    public function index()
    {
        $faqs = Faq::with('examination')
                    ->orderBy('examination_id')
                    ->orderBy('order')
                    ->paginate(10);
        return view('admin.faqs.index', compact('faqs'));
    }

    // 作成画面
    public function create()
    {
        $examinations = Examination::orderBy('order')->get();
        return view('admin.faqs.create', compact('examinations'));
    }

    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'examination_id' => 'nullable|exists:examinations,id',
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'order'    => 'required|integer|min:0',
        ]);

        Faq::create($request->only([
            'examination_id',
            'question',
            'answer',
            'order',
        ]));

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQを登録しました');
    }

    // 詳細
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    // 編集画面
    public function edit(Faq $faq)
    {
        $examinations = Examination::orderBy('order')->get();
        return view('admin.faqs.edit', compact('faq', 'examinations'));
    }

    // 更新
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'examination_id' => 'nullable|exists:examinations,id',
            'question'       => 'required|string|max:255',
            'answer'         => 'required|string',
            'order'          => 'required|integer|min:0',
        ]);

        $faq->update($request->only([
            'examination_id',
            'question',
            'answer',
            'order',
        ]));

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQを更新しました');
    }

    // 削除
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQを削除しました');
    }
}
