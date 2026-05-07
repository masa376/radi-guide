<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            チェックリスト 一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- フラッシュメッセージ --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 新規登録ボタン --}}
            <div class="mb-4 flex justify-end">
                <a href="{{ route('admin.checklists.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + 新規登録
                </a>
            </div>

            {{-- テーブル --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">検査名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">チェック項目</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">必須</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">表示順</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($checklists as $checklist)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $checklist->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $checklist->examination->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $checklist->item }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        {{ $checklist->is_required ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $checklist->is_required ? '必須' : '任意' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $checklist->order }}</td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <a href="{{ route('admin.checklists.show', $checklist) }}"
                                        class="text-blue-600 hover:underline">詳細</a>
                                    <a href="{{ route('admin.checklists.edit', $checklist) }}"
                                        class="text-yellow-600 hover:underline">編集</a>
                                    <form action="{{ route('admin.checklists.destroy', $checklist) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('削除しますか？')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    チェックリストが登録されていません
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- ページネーション --}}
                <div class="px-6 py-4">
                    {{ $checklists->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>