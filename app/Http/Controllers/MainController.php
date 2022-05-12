<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $articles = Article::with('category')
        ->whereHas('category', function($query){
            return $query->where('status','1');
        })
        ->where('status','1')
        ->latest()
        ->paginate(5);

        return view('front.index',compact('articles'));
    }

    /**
     * @param string $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(string $category_slug): View
    {
        $category = Category::where('slug',$category_slug)->where('status','1')->first() ?? abort(404);

        $articles = Article::with('category','createdBy')
        ->whereHas('category',function($query) use($category_slug){
            return $query->where('slug',$category_slug)->where('status','1');
        })
        ->where('status','1')
        ->latest()
        ->paginate(5);

        return view('front.list',compact('articles'));
    }

    /**
     * @param string $category
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail(string $category_slug, string $slug): View
    {
        if(Cache::has('article')){
            $article = Cache::get('article');
        }else{
            $article = Article::with('category')
            ->where('slug',$slug)
            ->where('status','1')
            ->whereHas('category',function($query) use($category_slug){
                return $query->where('slug',$category_slug)->where('status','1');
            })
            ->first() ?? abort(404);

            Cache::put('article', $article , 10);
        }

        return view('front.detail',compact('article'));
    }
}
