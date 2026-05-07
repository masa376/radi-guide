<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Examination;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['examinations' => function ($query) {
                            $query->published()->orderBy('order');
                        }])
                        ->orderBy('order')
                        ->get();

        $latestExaminations = Examination::published()
                                        ->with('category')
                                        ->orderBy('updated_at', 'desc')
                                        ->take(6)
                                        ->get();

        return view('public.home', compact('categories', 'latestExaminations'));
    }
}
