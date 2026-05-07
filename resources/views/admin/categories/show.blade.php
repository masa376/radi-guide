<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カテゴリ 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 詳細情報 --}}
                <div class="mb-6 space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">カテゴリ名</p>
                        <p class="mt-1 text-gray-900">{{ $category->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">スラッグ</p>
                        <p class="mt-1 text-gray-900">{{ $category->slug }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">表示順</p>
                        <p class="mt-1 text-gray-900">{{ $category->order }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">登録日時</p>
                        <p class="mt-1 text-gray-900">{{ $category->created_at->format('Y年m月d日 H:i') }}</p>
                    </div>
                </div>

                {{-- 紐づく検査一覧 --}}
                @if($category->examinations->count() > 0)
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-500 mb-2">紐づく検査 ({{ $category->examinations->count() }})件 </p>
                    <div class="bg-gray-50 rounded-md p-4 space-y-2">
                        @foreach($category->examinations as $examination)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-900">{{ $examination->title }}</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium>
                                    {{ $examination->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}}">
                                    {{ $examination->is_published ? '公開中' : '非公開' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.categories.edit', $category) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        編集する
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            削除する
                        </button>
                    </form>
                    <a href="{{ route('admin.categories.index') }}"
                        class="text-gray-600 hover:underline">
                        一覧に戻る
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>