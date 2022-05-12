<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $total_users = User::all()->count();
        $total_articles = Article::all()->count();
        $total_categories = Category::all()->count();

        return view('admin.index',compact('total_users','total_articles','total_categories'));
    }
}
