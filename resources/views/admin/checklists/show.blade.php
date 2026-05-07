<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            チェックリスト 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 必須バッチ --}}
                <div class="mb-6">
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $checklist->is_required ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $checklist->is_required ? '必須' : '任意' }}
                    </span>
                </div>

                {{-- 詳細情報 --}}
                <div class="mb-6 space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">検査名</p>
                        <p class="mt-1 text-gray-900">{{ $checklist->examination->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">チェック項目</p>
                        <p class="mt-1 text-gray-900">{{ $checklist->item }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">表示順</p>
                        <p class="mt-1 text-gray-900">{{ $checklist->order }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">登録日時</p>
                        <p class="mt-1 text-gray-900">{{ $checklist->created_at->format('Y年m月d日 H:i') }}</p>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.checklists.edit', $checklist) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        編集する
                    </a>
                    <form action="{{ route('admin.checklists.destroy', $checklist) }}"
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