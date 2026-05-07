<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            検査記事 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 公開状態バッチ --}}
                <div class="mb-6">
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $examination->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}}">
                        {{ $examination->is_published ? '公開中' : '非公開' }}
                    </span>
                </div>

                {{-- 詳細情報 --}}
                <div class="mb-6 space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">カテゴリ</p>
                        <p class="mt-1 text-gray-900">{{ $examination->category->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">タイトル</p>
                        <p class="mt-1 text-gray-900">{{ $examination->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">スラッグ</p>
                        <p class="mt-1 text-gray-500">{{ $examination->slug }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">概要</p>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $examination->description }}</p>
                    </div>
                    @if($examination->purpose)
                    <div>
                        <p class="text-sm font-medium text-gray-500">検査の目的</p>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $examination->purpose }}</p>
                    </div>
                    @endif
                    @if($examination->procedure)
                    <div>
                        <p class="text-sm font-medium text-gray-500">検査の流れ</p>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $examination->procedure }}</p>
                    </div>
                    @endif
                    @if($examination->duration)
                    <div>
                        <p class="text-sm font-medium text-gray-500">所要時間</p>
                        <p class="mt-1 text-gray-900">{{ $examination->duration }}分</p>
                    </div>
                    @endif
                    @if($examination->precautions)
                    <div>
                        <p class="text-sm font-medium text-gray-500">注意事項</p>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $examination->precautions }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">表示順</p>
                        <p class="mt-1 text-gray-900">{{ $examination->order }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">登録日時</p>
                        <p class="mt-1 text-gray-900">{{ $examination->created_at->format('Y年m月d日 H:i') }}</p>
                    </div>
                </div>

                {{-- チェックリスト --}}
                @if($examination->checklists->count() > 0)
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-500 mb-2">チェックリスト ({{ $examination->checklists->count() }})件
                    </p>
                    <div class="bg-gray-50 rounded-md p-4 space-y-2">
                        @foreach($examination->checklists as $checklist)
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    {{ $checklist->is_required ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gary-600' }}">
                                    {{ $checklist->is_required ? '必須' : '任意' }}
                                </span>
                                <span class="text-sm tet-gray-900">{{ $checklist->item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- FAQ --}}
                @if($examination->faqs->count() > 0)
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-500 mb-2">
                        FAQ（{{ $examination->faqs->count() }}件）
                    </p>
                    <div class="bg-gray-50 rounded-md p-4 space-y-3">
                        @foreach($examination->faqs as $faq)
                            <div>
                                <p class="text-sm font-medium text-gray-900">Q. {{ $faq->question }}</p>
                                <p class="mt-1 text-sm text-gray-600">A. {{ $faq->answer }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.examinations.edit', $examination) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        編集する
                    </a>
                    <form action="{{ route('admin.examinations.destroy', $examination) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            削除する
                        </button>
                    </form>
                    <a href="{{ route('admin.examinations.index') }}"
                        class="text-gray-600 hover:underline">
                        一覧に戻る
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>