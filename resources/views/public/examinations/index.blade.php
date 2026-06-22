<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検査一覧 - RadiGuide</title>
    @vite(['resources/css/app.css', 'resources/tsx/search.tsx'])
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

    {{-- パンくずリスト --}}
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:py-8 py-3">
            <nav class="text-sm text-gray-500 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600">ホーム</a>
                <span>></span>
                <span class="text-gray-900">検査一覧</span>
            </nav>
        </div>
    </div>

    {{-- ページタイトル --}}
    <section class="bg-blue-600 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">検査一覧</h1>
            <p class="mt-2 text-blue-100">放射線検査についてわかりやすく解説します</p>
        </div>
    </section>

    {{-- Reactコンポーネントのマウント先 --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div id="search-root"></div>
    </div>

    {{-- フッター --}}
    <footer class="bg-gray-800 text-gray-400 py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">© 2026 RadiGuide - 放射線検査ガイド</p>
        </div>
    </footer>

</body>
</html>