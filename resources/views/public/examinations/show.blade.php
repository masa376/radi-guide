<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $examination->title }} - RadiGuide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- ヘッダー --}}
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                RadiGuide
            </a>
            <nav class="flex items-center gap-6">
                <a href="{{ route('examinations.index') }}"
                    class="text-gray-600 hover:text-blue-600">検査一覧</a>
                <a href="{{ route('faqs.index') }}"
                    class="text-blue-600 font-medium">よくある質問</a>
                @auth
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                        管理者メニュー
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- パンくずリスト --}}
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="text-sm text-gray-500 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a>
                <span>›</span>
                <a href="{{ route('examinations.index') }}" class="hover:text-blue-600">検査一覧</a>
                <span>›</span>
                <a href="{{ route('examinations.index', ['category_id' => $examination->category->id]) }}"
                    class="hover:text-blue-600">{{ $examination->category->name }}</a>
                <span>›</span>
                <span class="text-gray-900">{{ $examination->title }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- タイトル --}}
        <div class="mb-8">
            <span class="text-sm text-blue-600 font-medium">{{ $examination->category->name }}</span>
            <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $examination->title }}</h1>
            @if($examination->duration)
                <p class="mt-2 text-gray-500">🕛 所要時間：約{{ $examination->duration }}分</p>
            @endif
        </div>

        {{-- 概要 --}}
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-3">検査について</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $examination->description }}</p>
        </div>

        {{-- 検査の目的 --}}
        @if($examination->purpose)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-3">検査の目的</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $examination->purpose }}</p>
        </div>
        @endif

        {{-- 検査の流れ --}}
        @if($examination->procedure)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-3">検査の流れ</h2>
            <p class="text-gray-700 whitespace-pre-line">{{ $examination->purpose }}</p>
        </div>
        @endif

        {{-- 注意事項 --}}
        @if($examination->precautions)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">⚠️ 注意事項</h2>
            <p class="text-yellow-700 whitespace-pre-line">{{ $examination->precautions }}</p>
        </div>
        @endif

        {{-- 検査前チェックリスト --}}
        @if($examination->checklists->count() > 0)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">検査前チェックリスト</h2>
            <div class="space-y-3">
                @foreach($examination->checklists as $checklist)
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5">
                            <span class="px-2 py-0.5 rounded text-xs font-medium
                                {{ $checklist->is_required ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $checklist->is_required ? '必須' : '任意' }}
                            </span>
                        </div>
                        <p class="text-gray-700">{{ $checklist->item }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- FAQ --}}
        @if($examination->faqs->count() > 0)
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">よくある質問</h2>
            <div class="space-y-4">
                @foreach($examination->faqs as $faq)
                    <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                        <p class="font-medium text-gray-900">Q. {{ $faq->question }}</p>
                        <p class="mt-2 text-gray-600 whitespace-pre-line">A. {{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- ボタン --}}
        <div class="flex items-center gap-4 mt-8">
            <a href="{{ route('examinations.index') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                検査一覧に戻る
            </a>
            <a href="{{ route('faqs.index') }}"
                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                よくある質問を見る
            </a>
        </div>

    </div>


    {{-- フッター --}}
    <footer class="bg-gray-800 text-gray-400 py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">© 2026 RadiGuide - 放射線検査ガイド</p>
        </div>
    </footer>

</body>
</html>