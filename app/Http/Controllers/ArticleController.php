<?php

namespace App\Http\Controllers;

use App\Article;
use App\Interfaces\TController;
use Illuminate\Http\Request;

class ArticleController extends TController
{
    /**
     * [WEB]
     *
     * Get all elements for web.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('models.articles')->with(['articles' => Article::all()]);
    }

    /**
     * [WEB]
     *
     * Display the specified element.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('models.article')->with(['article' => Article::findOrFail($id)]);
    }


    /**
     * [API]
     *
     * Get all elements in json
     *
     * @return string
     */
    public function all()
    {
        $user = $this->getUser();
        if ($user->theatre_id == 0) {
            $articles = Article::all();
        } else {
            $articles = Article::where('theatre_id', $user->theatre_id)->get();
        }

        return response()->json(['response' => $articles]);
    }

    /**
     * [API]
     *
     * Get element by specified $id
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        return response()->json(['response' => Article::findOrFail($id)]);
    }

    /**
     * [API]
     *
     * Create new element.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Article::where('name', $request->get('name'))->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        Article::create($this->getOnly($request, ['name', 'desc', 'desc_s']));

        $article = Article::all()->last();
        $article->theatre_id = $this->getUser()->theatre_id;
        $article->save();

        return response()->json(['response' => 'successful']);
    }

    /**
     * [API]
     *
     * Update the specified element.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $article = Article::findOrFail($request->get('id'));

        $article->update($this->getOnly($request, ['name', 'desc', 'desc_s']));
        $article->save();

        return response()->json(['response' => 'successful']);
    }

    /**
     * [API]
     *
     * Remove the specified element.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $m = Article::findOrFail($request->get('id'));
        $m->delete();
        return response()->json(['response' => 'successful']);

    }
}
