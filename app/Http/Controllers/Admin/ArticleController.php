<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;


class ArticleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $articles = Article::with('category','createdBy')->get();
        return view('admin.articles.index',compact('articles'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $categories = Category::get(['id','name','status']);
        return view('admin.articles.create',compact('categories'));
    }

    /**
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateArticleRequest $request): RedirectResponse
    {
        $file = $request->file('image');
        $filename = Str::slug($request->title).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/Articles'), $filename);
        $request->image = '/images/Articles/'.$filename;

        Article::create([
            'title'         => $request->title,
            'detail'        => $request->detail,
            'image'         => $request->image,
            'category_id'   => $request->category_id,
            'status'        => $request->status ? "1" : "0",
            'created_by'    => auth()->user()->id,
        ]);

        return redirect()->route('admin.articles.index')->with('success', __('articles.article_added'));
    }

    /**
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Article $article): View
    {
        $categories = Category::all();
        return view('admin.articles.edit',compact('article','categories'));
    }

    /**
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        if($request->file('image')){

            if(File::exists(public_path($article->image))){
                File::delete(public_path($article->image));
            }

            $file = $request->file('image');
            $filename = Str::slug($request->title).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/Articles'), $filename);
            $request->image = '/images/Articles/'.$filename;
        }

        Article::where('id', $article->id)
        ->update([
            'title'         => $request->title,
            'detail'        => $request->detail,
            'image'         => $request->image,
            'category_id'   => $request->category_id,
            'status'        => $request->status ? "1" : "0",
            'created_by'    => auth()->user()->id,
        ]);

        return redirect()->route('admin.articles.index')->with('success', __('articles.article_updated'));
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        if(File::exists(public_path($article->image))){
            File::delete(public_path($article->image));
        }

        $article->delete();
        return redirect()->back()->with('success', __('articles.article_deleted'));
    }
}
