<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * get all articles user.
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $article = Article::query();
        if (auth()->user()->is_admin)
            $articles = $article->where('title', 'like', "%$request->term%")->paginate(10);
        else
            $articles= auth()->user()->articles()->where('title', 'like', "%$request->term%")->paginate(10);
        return view('articles.index', compact('articles'))->with(['title' => 'articles']);
    }

    /**
     * get list all articles.
     * @return Application|Factory|View
     */
    public function list()
    {
        $articles = Article::paginate(10);
        return view('articles.list', compact('articles'))->with(['title' => 'articles']);
    }

    /**
     * show article.
     * @param Article $article
     * @return Application|Factory|View
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'))->with(['title' => $article->title]);
    }

    public function create()
    {
        return view('articles.create');
    }

    /**
     * @param StoreArticleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $save = auth()->user()->articles()->create($request->all());
        if ($save)
            return redirect()->route('articles')->with(['status' => 'save article successfully.']);
        return redirect()->back()->with(['status' => 'save article failed.']);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Article $article)
    {
        $this->authorize('edit', $article);
        return view('articles.edit', compact('article'))->with(['title' => $article->title]);
    }

    /**
     * update article.
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $this->authorize('update', $article);
        $update = $article->update($request->only($article->fillable));
        if ($update)
            return redirect()->route('articles');

        return redirect()->back()->with('error', ['error' => 'could not update article.']);
    }

    /**
     * delete article
     * @param Article $article
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->back();
    }
}
