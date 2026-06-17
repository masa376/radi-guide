<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $examination->title }} - 印刷用 | RadiGuide</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { font-size: 12pt; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body class="bg-white p-8 max-w-3xl mx-auto">

    {{-- 印刷・戻るボタン --}}
    <div class="no-print flex gap-4 mb-6">
        <button onclick="window.print()"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            🖨️ 印刷する
        </button>
        <a href="{{ route('examinations.show', $examination->slug) }}"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
            ← 戻る
        </a>
    </div>

    {{-- ヘッダー --}}
    <div class="border-b-2 border-blue-600 pb-4 mb-6">
        <p class="text-sm text-blue-600 font-medium">{{ $examination->category->name }}</p>
        <h1 class="text-2xl font-bold text-gray-900 mt-1">{{ $examination->title }}</h1>
        @if($examination->duration)
            <p class="text-sm text-gray-500 mt-1">所要時間：約{{ $examination->duration }}分</p>
        @endif
        <p class="text-xs text-gray-400 mt-2">印刷日：{{ now()->format('Y年m月d日') }}</p>
    </div>

    {{-- 概要 --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2 border-l-4 border-blue-600 pl-3">
            検査について
        </h2>
        <p class="text-gray-700 whitespace-pre-line">{{ $examination->description }}</p>
    </div>

    {{-- 検査の目的 --}}
    @if($examination->purpose)
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-2 border-l-4 border-blue-600 pl-3">
            検査の目的
        </h2>
        <p class="text-gray-700 whitespace-pre-line">{{ $examination->purpose }}</p>
    </div>
    @endif

    {{-- チェックリスト --}}
    @if($examination->checklists->count() > 0)
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-3 border-l-4 border-blue-600 pl-3">
            検査前チェックリスト
        </h2>
        <div class="space-y-2">
            @foreach($examination->checklists as $checklist)
                <div class="flex items-start gap-3 p-2 border-gray-200 rounded">
                    {{-- 印刷用チェックボックス --}}
                    <div class="w-5 h-5 border-2 border-gray-400 rounded flex-shrink-0 mt-0.5"></div>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded text-xs font-medium
                            {{ $checklist->is_required ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $checklist->is_required ? '必須' : '任意' }}
                        </span>
                        <p class="text-gray-700 text-sm">{{ $checklist->item }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- FAQ --}}
    @if($examination->faqs->count() > 0)
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-3 border-l-4 border-blue-600 pl-3">
            よくある質問
        </h2>
        <div class="space-y-3">
            @foreach($examination->faqs as $faq)
                <div class="border border-gray-200 rounded p-3">
                    <p class="font-medium text-gray-900 text-sm">Q. {{ $faq->question }}</p>
                    <p class="mt-1 text-gray-600 text-sm whitespace-pre-line">A. {{ $faq->answer }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- フッター --}}
    <div class="border-t border-gray-200 pt-4 mt-8 text-center">
        <p class="text-xs text-gray-400">RadiGuide - 放射線検査ガイド</p>
    </div>
</body>
</html>