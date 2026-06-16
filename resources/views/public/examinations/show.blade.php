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

            {{-- 所要時間タイムライン --}}
            @if($examination->duration)
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    🕒 所要時間の目安：約{{ $examination->duration }}分
                </h2>

                {{-- プログレスバー --}}
                <div class="mb-6">
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-blue-600 h-3 rounded-full"
                            style="width: 100%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>開始</span>
                        <span>{{ $examination->duration }}分後</span>
                    </div>
                </div>

                {{-- タイムライン --}}
                <div class="relative">
                    {{-- 縦線 --}}
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-blue-200"></div>

                    <div class="space-y-4">
                        {{-- 受付・問診 --}}
                        <div class="flex items-start gap-4 relative">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <span class="text-white text-xs font-bold">1</span>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3 flex-1">
                                <p class="font-medium text-gray-900 text-sm">受付・問診票記入</p>
                                <p class="text-xs text-gray-500 mt-1">0分～</p>
                            </div>
                        </div>

                        {{-- 準備 --}}
                        <div class="flex items-start gap-4 relative">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <span class="text-white text-xs font-bold">2</span>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3 flex-1">
                                <p class="font-medium text-gray-900 text-sm">更衣・検査準備</p>
                                <p class="text-xs text-gray-500 mt-1">約{{ round($examination->duration * 0.15) }}分～</p>
                            </div>
                        </div>

                        {{-- 検査 --}}
                        <div class="flex items-start gap-4 relative">
                            <div class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <span class="text-white text-xs font-bold">3</span>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3 flex-1">
                                <p class="font-medium text-gray-900 text-sm">検査実施</p>
                                <p class="text-xs text-gray-500 mt-1">約{{ round($examination->duration * 0.3) }}分～</p>
                            </div>
                        </div>

                        {{-- 終了 --}}
                        <div class="flex items-start gap-4 relative">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 z-10">
                                <span class="text-white text-xs font-bold">✓</span>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3 flex-1">
                                <p class="font-medium text-gray-900 text-sm">検査終了・着替え</p>
                                <p class="text-xs text-gray-500 mt-1">約{{ round($examination->duration * 0.85) }}分～</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6"
            x-data="{
                items: {{ $examination->checklists->map(fn($c) => ['id' => $c->id, 'checked' => false])->toJson() }},
                get allChecked() {
                    return this.items.every(item => item.checked);
                },
                get checkedCount() {
                    return this.items.filter(item => item.checked).length;
                }
            }">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">検査前チェックリスト</h2>
                <span class="text-sm text-gray-500">
                    <span x-text="checkedCount"></span> / {{ $examination->checklists->count() }} 完了
                </span>
            </div>

            {{-- 全完了バッチ --}}
            <div x-show="allChecked"
                x-transition
                class="mb-4 p-3 bg-green-100 border border-green-300 rounded-md text-center">
                <p class="text-green-700 font-medium">✅ 全ての項目を確認しました！準備完了です。</p>
            </div>

            {{-- チェックリスト項目 --}}
            <div class="space-y-3">
                @foreach($examination->checklists as $index => $checklist)
                    <div class="flex items-start gap-3 p-3 rounded-md"
                        :class="items[{{ $index }}].checked ? 'bg-green-50' : 'bg-gray-50'">
                        <input type="checkbox"
                                x-model="items[{{ $index }}].checked"
                                class="mt-0.5 w-5 h-5 rounded border-gray-300 text-green-600 cursor-pointer">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-xs font-medium 
                                    {{ $checklist->is_required ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $checklist->is_required ? '必須' : '任意' }}
                                </span>
                                <p class="text-gray-700"
                                    :class="items[{{ $index }}].checked ? 'line-through text-gray-400' : ''">
                                    {{ $checklist->item }}
                                </p>
                            </div>
                        </div>
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