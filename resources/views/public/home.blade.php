<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RadiGuide - 放射線検査ガイド</title>
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
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 text-sm">
                                管理者ログイン
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
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 text-sm">
                                    管理者ログイン
                            </a>
                            @endauth
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ヒーローセレクション --}}
    <section class="bg-blue-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">
                放射線検査について<br>わかりやすく解説します
            </h1>
            <p class="text-xl text-blue-100 mb-8">
                検査前の準備・検査の流れ・よくある質問をまとめました
            </p>
            {{-- 検査フォーム --}}
            <form action="{{ route('examinations.index') }}" method="GET"
                    class="max-w-lg mx-auto flex gap-2">
                <input type="text" name="keyword"
                        placeholder="検査名で検索..."
                        class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                <button type="submit"
                        class="px-6 py-3 bg-white text-blue-600 font-medium rounded-lg hover:bg-blue-50">
                    検索
                </button>
            </form>
        </div>
    </section>

    {{-- カテゴリ別検査一覧 --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">検査種別から探す</h2>

            @forelse($categories as $category)
                @if($category->examinations->count() > 0)
                <div class="mb-10">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                        {{ $category->name }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($category->examinations as $examination)
                            <a href="{{ route('examinations.show', $examination->slug) }}"
                                class="bg-white rounded-lg shadow-sm p-5 hover:shadow-md transition-shadow">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $examination->title }}</h4>
                                <p class="text-sm text-gray-500 line-clamp-2">{{ $examination->description }}</p>
                                @if($examination->duration)
                                    <p class="mt-3 text-xs text-blue-600">🕛 約{{ $examination->duration }}分</p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            @empty
                <p class="text-gray-500 text-center">検査情報がまだ登録されていません</p>
            @endforelse
        </div>
    </section>

    {{-- 最新の検査情報 --}}
    @if($latestExaminations->count() > 0)
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">最新の検査情報</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($latestExaminations as $examination)
                    <a href="{{ route('examinations.show', $examination->slug) }}"
                        class="border border-gray-200 rounded-lg p-5 hover:border-blue-300 transition-colors">
                        <span class="text-xs text-blue-600 font-medium">{{ $examination->category->name }}</span>
                        <h4 class="mt-1 font-medium text-gray-900">{{ $examination->title }}</h4>
                        <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ $examination->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- フッター --}}
    <footer class="bg-gray-800 text-gray-400 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">© 2026 RadiGuide - 放射線検査ガイド</p>
        </div>
    </footer>

</body>
</html>