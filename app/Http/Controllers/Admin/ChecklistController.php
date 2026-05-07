<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checklist;
use App\Models\Examination;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    // 一覧
    public function index()
    {
        $checklists = Checklist::with('examination')
                                ->orderBy('examination_id')
                                ->orderBy('order')
                                ->paginate(10);
        return view('admin.checklists.index', compact('checklists'));
    }

    // 作成動画
    public function create()
    {
        $examinations = Examination::orderBy('order')->get();
        return view('admin.checklists.create', compact('examinations'));
    }

    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'examination_id' => 'required|exists:examinations,id',
            'item'           => 'required|string|max:255',
            'is_required'    => 'boolean',
            'order'          => 'required|integer|min:0',
        ]);

        Checklist::create([
            ...$request->only([
                'examination_id',
                'item',
                'order',
            ]),
            'is_required' => $request->boolean('is_required'),
        ]);

        return redirect()->route('admin.checklists.index')
            ->with('success', 'チェックリストを登録しました');
    }

    // 詳細
    public function show(Checklist $checklist)
    {
        return view('admin.checklists.show', compact('checklist'));
    }

    // 編集画面
    public function edit(Checklist $checklist)
    {
        $examinations = Examination::orderBy('order')->get();
        return view('admin.checklists.edit', compact('checklist', 'examinations'));
    }

    // 更新
    public function update(Request $request, Checklist $checklist)
    {
        $request->validate([
            'examination_id' => 'required|exists:examinations,id',
            'item'           => 'required|string|max:255',
            'is_required'    => 'boolean',
            'order'          => 'required|integer|min:0',
        ]);

        $checklist->update([
            ...$request->only([
                'examination_id',
                'item',
                'order',
            ]),
            'is_required' => $request->boolean('is_required'),
        ]);

        return redirect()->route('admin.checklists.index')
            ->with('success', 'チェックリストを更新しました');
    }

    // 削除
    public function destroy(Checklist $checklist)
    {
        $checklist->delete();
        return redirect()->route('admin.checklists.index')
            ->with('success', 'チェックリストを削除しました');
    }
}
