<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            FAQ 新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf

                    {{-- 検査記事（任意） --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査記事
                            <span class="text-red-400 text-xs">（未選択の場合は全般FAQになります）</span>
                        </label>
                        <select name="examination_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 全般FAQ --</option>
                            @foreach($examinations as $examination)
                                <option value="{{ $examination->id }}"
                                    {{ old('examination_id') == $examination->id ? 'selected' : '' }}>
                                    {{ $examination->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('examination_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 質問 --}}
                    <div class="mb-4">
                        <label class="black text-sm font-medium text-gray-700 mb-1">
                            質問 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="question" value="{{ old('question') }}"
                                placeholder="例：CT検査は痛いですか？"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('question')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 回答 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            回答 <span class="text-red-500">*</span>
                        </label>
                        <textarea name="answer" rows="4"
                                    class="w-full border-gray-300 rounded-md shadow-sm"
                                    placeholder="例：CT検査は痛みを伴わない検査です。">{{ old('answer')}}</textarea>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 表示順 --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gary-700 mb-1">
                            表示順 <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="order" value="{{ old('order', 0) }}"
                                min="0" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            登録する
                        </button>
                        <a href="{{ route('admin.faqs.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>