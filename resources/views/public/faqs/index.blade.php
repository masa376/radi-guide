<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>よくある質問 - RadiGuide</title>
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

    {{-- ページタイトル --}}
    <section class="bg-blue-600 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">よくある質問</h1>
            <p class="mt-2 text-blue-100">放射線検査に関するよくある質問をまとめました</p>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- 全般FAQ --}}
        @if($generalFaqs->count() > 0)
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b border-gray-200">
                全般的なご質問
            </h2>
            <div class="space-y-4">
                @foreach($generalFaqs as $faq)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <p class="font-medium text-gray-900">Q. {{ $faq->question }}</p>
                        <p class="mt-3 text-gray-600 whitespace-pre-line">A. {{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- 検査別FAQ --}}
        @forelse($examinations as $examination)
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-6 pb-2 bolder-b border-gray-200">
                {{ $examination->title }}に関するご質問
            </h2>
            <div class="space-y-4">
                @foreach($examination->faqs as $faq)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <p class="font-medium text-gray-900">Q. {{ $faq->question }}</p>
                        <p class="mt-3 text-gray-600 whitespace-pre-line">A. {{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        @empty
            @if($generalFaqs->count() === 0)
                <div class="text-center py-12 text-gray-500">
                    FAQがまだ登録されていません
                </div>
            @endif
        @endforelse

        {{-- 検査一覧へのリンク --}}
        <div class="mt-12 text-center">
            <p class="text-gray-600 mb-4">検査の詳細情報はこちらから</p>
            <a href="{{ route('examinations.index') }}"
                class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                検査一覧を見る
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