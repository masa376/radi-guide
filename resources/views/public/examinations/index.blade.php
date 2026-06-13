<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検査一覧 - RadiGuide</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- ヘッダー --}}
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                    RadiGuide
                </a>

                {{-- スマホ用 --}}
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                            class="sm:hidden p-2 rounded-md text-gray-600 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    {{-- PC用ナビ --}}
                    <nav class="hidden sm:flex items-center gap-6">
                        <a href="{{ route('examinations.index') }}"
                            class="text-gray-600 hover:text-blue-600">検査一覧</a>
                        <a href="{{ route('faqs.index') }}"
                            class="text-gray-600 hover:text-blue-600">よくある質問</a>
                        @auth
                            <a href="{{ route('admin.categories.index') }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                管理者メニュー
                            </a>
                        @endauth
                    </nav>

                    {{-- スマホ用ドロップダウンナビ --}}
                    <div x-show="open"
                        x-transition
                        class="absolute top-16 left-0 bg-white shadow-md sm:hidden z-50">
                        <nav class="flex flex-col px-4 py-3 space-y-3">
                            <a href="{{ route('examinations.index') }}"
                                class="text-gray-600 hover:text-blue-600 py-2 border-b border-gray-100">
                                検査一覧
                            </a>
                            <a href="{{ route('faqs.index') }}"
                                class="text-gray-600 hover:text-blue-600 py-2 border-b border-gray-100">
                                よくある質問
                            </a>
                            @auth
                                <a href="{{ route('admin.categories.index') }}"
                                    class="text-blue-600 hover:text-blue-700 py-2">
                                    管理者メニュー
                                </a>
                            @endauth
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ページタイトル --}}
    <section class="bg-blue-600 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">検査一覧</h1>
            <p class="mt-2 text-blue-100">放射線検査についてわかりやすく解説します</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- 検索・絞り込みフォーム --}}
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form action="{{ route('examinations.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-4">
                <input type="text" name="keyword" value="{{ $keyword }}"
                        placeholder="検査名・説明で検索..."
                        class="flex-1 border-gray-300 rounded-md shadow-sm">
                <select name="category_id"
                        class="border-gray-300 rounded-md shadow-sm">
                    <option value="">すべてのカテゴリ</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    検索
                </button>
                @if($keyword || $categoryId)
                    <a href="{{ route('examinations.index') }}"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-center">
                        リセット
                    </a>
                @endif
            </form>
        </div>

        {{-- 検索結果件数 --}}
        <p class="text-sm text-gray-500 mb-4">
            {{ $examinations->total() }}件の検査が見つかりました
        </p>

        {{-- 検査一覧 --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($examinations as $examination)
                <a href="{{ route('examinations.show', $examination->slug) }}"
                    class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
                    <span class="text-xs text-blue-600 font-medium">
                        {{ $examination->category->name }}
                    </span>
                    <h3 class="mt-2 font-semibold text-gray-900">{{ $examination->title }}</h3>
                    <p class="mt-2 text-sm text-gray-500 line-clamp-3">
                        {{ $examination->description }}
                    </p>
                    <div class="mt-4 flex items-center gap-4 text-xs text-gray-400">
                        @if($examination->duration)
                            <span>🕛 約{{ $examination->duration }}分</span>
                        @endif
                        @if($examination->checklists->count() > 0)
                            <span>✅ 事前チェックあり</span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    該当する検査が見つかりませんでした
                </div>
            @endforelse
        </div>

        {{-- ページネーション --}}
        <div class="mt-8">
            {{ $examinations->appends(request()->query())->links() }}
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