<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            FAQ 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 種別バッチ --}}
                <div class="mb-6">
                    @if($faq->examination)
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                            {{ $faq->examination->title }}
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                            全般FAQ
                        </span>
                    @endif
                </div>

                {{-- 詳細情報 --}}
                <div class="mb-6 space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">質問</p>
                        <p class="mt-1 text-gray-900">{{ $faq->question }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">回答</p>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $faq->answer }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">表示順</p>
                        <p class="mt-1 text-gray-900">{{ $faq->order }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">登録日時</p>
                        <p class="mt-1 text-gray-900">{{ $faq->created_at->format('Y年m月d日 H:i') }}</p>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.faqs.edit', $faq) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        編集する
                    </a>
                    <form action="{{ route('admin.faqs.destroy', $faq) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            削除する
                        </button>
                    </form>
                    <a href="{{ route('admin.faqs.index') }}"
                        class="text-gray-600 hover:underline">
                        一覧に戻る
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>