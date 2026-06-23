import { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';

interface ChecklistItem {
    id: number;
    item: string;
    is_required: boolean;
}

interface ChecklistProps {
    items: ChecklistItem[];
    examinationSlug: string;
}

function Checklist({ items, examinationSlug }: ChecklistProps) {
    const storageKey = `checklist_${examinationSlug}`;

    // localStorageから初期状態を復元
    const [checked, setChecked] = useState<Record<number, boolean>>(() => {
        try {
            const saved = localStorage.getItem(storageKey);
            return saved ? JSON.parse(saved) : {};
        } catch {
            return {};
        }
    });

    const [celebrate, setCelebrate] = useState(false);

    // チェック状態をlocalStorageに保存
    useEffect(() => {
        localStorage.setItem(storageKey, JSON.stringify(checked));
    }, [checked, storageKey]);

    // 全完了チェック
    const checkedCount = Object.values(checked).filter(Boolean).length;
    const totalCount   = items.length;
    const allChecked   = checkedCount === totalCount && totalCount > 0;
    const progress = totalCount > 0 ? (checkedCount / totalCount) * 100 : 0;

    // 全完了時に紙吹雪
    useEffect(() => {
        if (allChecked) {
            setCelebrate(true);
            const timer = setTimeout(() => setCelebrate(false), 3000);
            return () => clearTimeout(timer);
        }
    }, [allChecked]);

    const toggleCheck = (id: number) => {
        setChecked(prev => ({ ...prev, [id]: !prev[id] }));
    };

    const resetAll = () => {
        setChecked({});
    };

    return (
        <div className="bg-white rounded-lg shadow-sm p-6 mb-6">
            {/* ヘッダー */}
            <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold text-gray-900">
                    検査前チェックリスト
                </h2>
                <div className="flex items-center gap-3">
                    <span className="text-sm text-gray-500">
                        {checkedCount} / {totalCount} 完了
                    </span>
                    <button
                        onClick={resetAll}
                        className="text-xs text-gray-400 hover:text-gray-600 underline"
                    >
                        リセット
                    </button>
                </div>
            </div>

            {/* 進捗バー */}
            <div className="mb-6">
                <div className="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div
                        className="h-3 rounded-full transition-all duration-500 ease-out"
                        style={{
                            width: `${progress}%`,
                            backgroundColor: allChecked ? "#10B981" : "#3B82F6",
                        }}
                    />
                </div>
            </div>

            {/* 全完了バッチ */}
            {allChecked && (
                <div className={`mb-4 p-3 bg-green-100 border border-green-300 rounded-md text-center transition-all duration-300
                ${celebrate ? "scale-105" : ""}`}>
                    <p className="text-green-700 font-medium">
                        🎉全ての項目を確認しました！準備完了です。
                    </p>
                </div>
            )}

            {/* チェックリスト項目 */}
            <div className="space-y-3">
                {items.map(item => (
                    <div
                        key={item.id}
                        onClick={() => toggleCheck(item.id)}
                        className={`flex items-start gap-3 p-3 rounded-md cursor-pointer transition-colors duration-200 ${
                            checked[item.id] ? 'bg-green-50' : 'bg-gray-50 hover:bg-gray-100'
                        }`}
                    >
                        {/* チェックボックス */}
                        <div className={`w-5 h-5 rounded border-2 flex-shrink-0 mt-0.5 flex items-center justify-center transition-colors duration-200 ${
                            checked[item.id]
                                ? 'bg-green-500 border-green-500'
                                : 'border-gray-300'
                        }`}>
                            {checked[item.id] && (
                                <svg className="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={3} d="M5 13l4 4L19 7" />
                                </svg>
                            )}
                        </div>

                        {/* 項目内容 */}
                        <div className="flex-1">
                            <div className="flex items-center gap-2">
                                <span className={`px-2 py-0.5 rounded text-xs font-medium ${
                                    item.is_required
                                        ? 'bg-red-100 text-red-700'
                                        : 'bg-gray-100 text-gray-600'
                                }`}>
                                    {item.is_required ? '必須' : '任意'}
                                </span>
                                <p className={`text-gray-700 text-sm transition-all duration-200 ${
                                    checked[item.id] ? 'line-through text-gray-400' : ''
                                }`}>
                                    {item.item}
                                </p>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}

// Reactをマウント
const container = document.getElementById('checklist-root');
if (container) {
    const items = JSON.parse(container.dataset.items || '[]');
    const slug = container.dataset.slug || '';
    createRoot(container).render(<Checklist items={items} examinationSlug={slug} />);
}