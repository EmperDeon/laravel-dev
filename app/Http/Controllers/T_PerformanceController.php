<?php

namespace App\Http\Controllers;

use App\Interfaces\TController;
use App\Performance;
use App\Poster;
use App\T_Performance;
use Illuminate\Http\Request;

class T_PerformanceController extends TController
{
    /**
     * Get all elements for web.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $p = T_Performance
            ::by_type($request->get('by_type'))
            ->by_theatre($request->get('by_theatre'))
            ->get();

        return view('models.perfs')->with(['perfs' => $p]);
    }


    /**
     * Display the specified element.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('models.perf')->with([
            'perf' => T_Performance::findOrFail($id),
            'posters' => Poster::by_performance($id, 3)->get()
        ]);
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
        $articles = T_Performance::query();

        if ($user->theatre_id != 0) {
            $articles = $articles->where('theatre_id', $user->theatre_id);
        }
        $articles = $articles->get();

        $r = [];

        foreach ($articles as $ar) {
            $a = [];
            $a['id'] = $ar->id;
            $a['name'] = $ar->perf->name;
            $a['author'] = $ar->perf->author;
            $a['type'] = $ar->perf->type->name;
            $a['desc'] = $ar->desc;
            $a['desc_s'] = $ar->desc_s;
            $r[] = $a;
        }


        return response()->json(['response' => $r]);
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
        return response()->json(['response' => T_Performance::findOrFail($id)]);
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
        if ($request->has('name')) {
            Performance::create($this->getOnly($request, ['name', 'author', 'type_id']));
            $p_id = Performance::all()->last()->id;

        } else {
            $p_id = $request->get('perf_id');
        }

        $theatre_id = $this->getUser()->theatre_id;

        if (T_Performance::where([['perf_id', '=', $p_id], ['theatre_id', '=', $theatre_id]])->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        $perf = new T_Performance;
        $perf->perf_id = $p_id;
        $perf->theatre_id = $theatre_id;
        $perf->desc = $request->get('desc');
        $perf->desc_s = $request->get('desc_s');
        $perf->save();

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

        $article = T_Performance::findOrFail($request->get('id'));

        $article->update($this->getArgs($request));
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
    public function delete(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $m = T_Performance::findOrFail($request->get('id'));
        $m->delete();
        return response()->json(['response' => 'successful']);

    }

    /**
     * Get from request only items of $fillable(model)
     *
     * @param Request $request
     * @return array
     */
    private function getArgs(Request $request):array
    {
        return $this->getOnly($request, (new T_Performance)->getFillable());
    }
}
