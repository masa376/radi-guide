<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        // 全般FAQ（examination_idがnull）
        $generalFaqs = Faq::general()
                        ->orderBy('order')
                        ->get();

        // 検査別FAQ（examination_idがあるもの）
        $examinations = Examination::published()
                                ->with(['faqs' => function ($query) {
                                    $query->orderBy('order');
                                }])
                                ->has('faqs')
                                ->orderBy('order')
                                ->get();
        return view('public.faqs.index', compact('generalFaqs', 'examinations'));
    }
}
