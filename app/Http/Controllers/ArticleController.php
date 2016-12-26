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
        return view('models.articles')->with(['articles' => Article::query()->orderBy('id', 'desc')->get()]);
    }

    /**
     * [WEB]
     *
     * Display the specified element.
     *
     * @param  int $id
     * @return \Illuminate\View\View
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $user = $this->getUser();
        $articles = Article::query()->orderBy('id', 'desc');

        if ($user->theatre_id != 0) {
            $articles = $articles->where('theatre_id', $user->theatre_id);
        }

        return response()->json(['response' => $articles->get()]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (Article::where('name', $request->get('name'))->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        Article::create($this->getArgs($request));

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $article = Article::findOrFail($request->get('id'));

        $article->update($this->getArgs($request));
        $article->save();

        return response()->json(['response' => 'successful']);
    }

    /**
     * [API]
     *
     * Remove the specified element.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $m = Article::findOrFail($request->get('id'));
        $m->delete();
        return response()->json(['response' => 'successful']);

    }

    /**
     * Get from request only items of $fillable(model)
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    private function getArgs(Request $request):array
    {
        return $this->getOnly($request, (new Article)->getFillable());
    }
}
