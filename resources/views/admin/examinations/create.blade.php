<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            検査記事 新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.examinations.store') }}" method="POST">
                    @csrf

                    {{-- カテゴリ名 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            カテゴリ名 <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- タイトル --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            タイトル <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}"
                                placeholder="例：胸部CT検査"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- スラッグ --}}
                    <div class="mb-4">
                        <label class="black text-sm font-medium text-gray-700 mb-1">
                            スラッグ <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="slug" value="{{ old('slug') }}"
                                placeholder="例：chest-ct（英小文字・数字・ハイフンのみ）"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 概要 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            概要 <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" rows="4"
                                    class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 検査の目的 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査の目的
                        </label>
                        <textarea name="purpose" rows="3"
                                    class="w-full border-gray-300 rounded-md shadow-sm">{{ old('purpose') }}</textarea>
                        @error('purpose')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 検査の流れ --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査の流れ
                        </label>
                        <textarea name="procedure" rows="4"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="例：&#13;&#10;1. 更衣室で検査着に着替えます&#13;&#10;2. 検査台で横になります&#13;&#10;3. 撮影を行います（約10分）">{{ old('procedure')}}</textarea>
                        @error('procedure')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 所要時間 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            所要時間（分）
                        </label>
                        <input type="number" name="duration" value="{{ old('duration') }}"
                                min="1" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 注意事項 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            注意事項
                        </label>
                        <textarea name="precautions" rows="3"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="例：造影剤を使用する場合は事前にアレルギーの確認が必要です">{{ old('precautions')}}</textarea>
                        @error('precautions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 表示順 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gary-700 mb-1">
                            表示順 <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="order" value="{{ old('order', 0) }}"
                                min="0" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 公開フラグ --}}
                    <div class="mb-6">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" value="1"
                                    {{ old('is_published') ? 'checked' : '' }}
                                    class="rounded border-gray-300">
                            <span class="text-sm font-medium text-gray-700">公開する</span>
                        </label>
                        @error('is_published')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            登録する
                        </button>
                        <a href="{{ route('admin.examinations.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>