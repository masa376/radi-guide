<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ダッシュボード
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ウェルカムメッセージ表示 --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    ようこそ、{{ Auth::user()->name }} さん！
                </h3>
                <p class="text-gray-600">
                    RadiGuide 管理画面へログインしました。
                </p>
            </div>

            {{-- ナビゲーションカード --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">

                {{-- 一般ページへ --}}
                <a href="{{ route('home') }}"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl">🏥</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">一般ページを見る</h4>
                            <p class="text-sm text-gray-500 mt-1">患者向けサイトのトップページへ</p>
                        </div>
                        <span class="ml-auto text-gray-400">›</span>
                    </div>
                </a>

                {{-- 検査記事管理へ --}}
                <a href="{{ route('admin.examinations.index') }}"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl">📝</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">検査記事を管理する</h4>
                            <p class="text-sm text-gray-500 mt-1">検査記事の投稿・編集・削除</p>
                        </div>
                        <span class="ml-auto text-gray-400">›</span>
                    </div>
                </a>

                {{-- カテゴリ管理へ --}}
                <a href="{{ route('admin.categories.index') }}"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl">📂</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">カテゴリを管理する</h4>
                            <p class="text-sm text-gray-500 mt-1">検査カテゴリの追加・編集・削除</p>
                        </div>
                        <span class="ml-auto text-gray-400">›</span>
                    </div>
                </a>

                {{-- FAQ管理へ --}}
                <a href="{{ route('admin.faqs.index') }}"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl">❓</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">FAQを管理する</h4>
                            <p class="text-sm text-gray-500 mt-1">よくある質問の追加・編集・削除</p>
                        </div>
                        <span class="ml-auto text-gray-400">›</span>
                    </div>
                </a>

                {{-- チェックリスト管理へ --}}
                <a href="{{ route('admin.checklists.index') }}"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl">✅</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">チェックリストを管理する</h4>
                            <p class="text-sm text-gray-500 mt-1">検査前チェックの追加・編集・削除</p>
                        </div>
                        <span class="ml-auto text-gray-400">›</span>
                    </div>
                </a>

                {{-- プロフィール編集へ --}}
                <a href="{{ route('profile.edit') }}"
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow block">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl">👤</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">プロフィール編集</h4>
                            <p class="text-sm text-gray-500 mt-1">アカウント情報変更</p>
                        </div>
                        <span class="ml-auto text-gray-400">›</span>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
