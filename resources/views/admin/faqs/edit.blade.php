<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            FAQ 編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 検査記事（任意） --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査記事
                            <span class="text-gray-400 text-xs">（未選択の場合は全般FAQになります）</span>
                        </label>
                        <select name="examination_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 全般FAQ --</option>
                            @foreach($examinations as $examination)
                                <option value="{{ $examination->id }}"
                                    {{ old('examination_id', $faq->examination_id) == $examination->id ? 'selected' : '' }}>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            質問 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="question"
                                value="{{ old('question', $faq->question) }}"
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
                                    class="w-full border-gray-300 rounded-md shadow-sm">{{ old('answer', $faq->answer) }}</textarea>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 表示順 --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            表示順 <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="order"
                                value="{{ old('order', $faq->order) }}"
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