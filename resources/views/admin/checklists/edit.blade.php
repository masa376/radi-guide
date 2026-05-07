<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            チェックリスト 編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.checklists.update', $checklist) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 検査記事 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査記事 <span class="text-red-500">*</span>
                        </label>
                        <select name="examination_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($examinations as $examination)
                                <option value="{{ $examination->id }}"
                                    {{ old('examination_id', $checklist->examination_id) == $examination->id ? 'selected' : '' }}>
                                    {{ $examination->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('examination_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- チェック項目 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            チェック項目 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="item"
                                value="{{ old('item', $checklist->item) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('item')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 必須フラグ --}}
                    <div class="mb-4">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_required" value="1"
                                    {{ old('is_required', $checklist->is_required) ? 'checked' : '' }}
                                    class="rounded border-gray-300">
                            <span class="text-sm font-medium text-gray-700">必須項目にする</span>
                        </label>
                        @error('is_required')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 表示順 --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            表示順 <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="order"
                                value="{{ old('order', $checklist->order) }}"
                                min="0" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            更新する
                        </button>
                        <a href="{{ route('admin.checklists.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>