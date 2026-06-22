import { useState, useEffect, useCallback } from 'react';
import { createRoot } from 'react-dom/client';

interface Category {
    id: number;
    name: string;
}

interface Examination {
    id: number;
    title: string;
    slug: string;
    description: string;
    duration: number | null;
    category: Category;
    checklists_count: number;
}

interface SearchResponse {
    data: Examination[];
    total: number;
}

export default function Search() {
    const [keyword, setKeyword]       = useState('');
    const [categoryId, setCategoryId] = useState('');
    const [examinations, setExaminations] = useState<Examination[]>([]);
    const [total, setTotal]           = useState(0);
    const [loading, setLoading]       = useState(false);
    const [categories, setCategories] = useState<Category[]>([]);


    // カテゴリ一覧取得
    useEffect(() => {
        fetch('/api/categories')
            .then(res => res.json())
            .then(data => setCategories(data));
    }, []);


    // 検索実行
    const search = useCallback(async () => {
        setLoading(true);
        const params = new URLSearchParams();
        if (keyword) params.append('keyword', keyword);
        if (categoryId) params.append('category_id', categoryId);

        const res = await fetch(`/api/examinations?${params}`);
        const data: SearchResponse = await res.json();
        setExaminations(data.data);
        setTotal(data.total);
        setLoading(false);
    }, [keyword, categoryId]);


    // キーワード・カテゴリ変更時に検索
    useEffect(() => {
        const timer = setTimeout(() => {
            search();
        }, 300);      // 300ms debounce

        return () => clearTimeout(timer);
    }, [keyword, categoryId, search]);

    return (
        <div>
            {/* 検索フォーム */}
            <div className="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div className="flex flex-col sm:flex-row gap-4">
                    <input
                        type="text"
                        value={keyword}
                        onChange={e => setKeyword(e.target.value)}
                        placeholder="検査名・説明で検索..."
                        className="flex-1 border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <select
                        value={categoryId}
                        onChange={e => setCategoryId(e.target.value)}
                        className="border-gray-300 rounded-md shadow-sm px-4 py-2 border focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">すべてのカテゴリ</option>
                        {categories.map(category => (
                            <option key={category.id} value={category.id}>
                                {category.name}
                            </option>
                        ))}
                    </select>
                </div>
            </div>

            {/* 検索結果件数 */}
            <p className="text-sm text-gray-500 mb-4">
                {loading ? '検索中...' : `${total}件の検査が見つかりました`}
            </p>

            {/* 検査一覧 */}
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {examinations.map(examination => (
                    <a
                        key={examination.id}
                        href={`/examinations/${examination.slug}`}
                        className="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow block"
                    >
                        <span className="text-xs text-blue-600 font-medium">
                            {examination.category.name}
                            </span>
                        <h3 className="mt-2 font-semibold text-gray-900">
                            {examination.title}
                        </h3>
                        <p className="mt-2 text-sm text-gray-500 line-clamp-3">
                            {examination.description}
                        </p>
                        <div className="mt-4 flex items-center gap-4 text-xs text-gray-400">
                            {examination.duration && (
                                <span>🕒 約{examination.duration}分</span>
                            )}
                            {examination.checklists_count > 0 && (
                                <span>✅ 事前チェックあり</span>
                            )}
                        </div>
                    </a>
                ))}
                {!loading && examinations.length === 0 && (
                    <div className="col-span-3 text-center py-12 text-gray-500">
                        該当する検査が見つかりませんでした
                    </div>
                )}
            </div>
        </div>
    )
}

const container = document.getElementById('search-root');
if (container) {
    createRoot(container).render(<Search />);
}