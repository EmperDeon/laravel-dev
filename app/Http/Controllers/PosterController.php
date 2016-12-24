<?php

namespace App\Http\Controllers;

use App\Interfaces\TController;
use App\Poster;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class PosterController extends TController
{
    /**
     * Get all elements for web.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $p = Poster
            ::by_month($request->get('by_month'))
            ->by_type($request->get('by_type'))
            ->by_theatre($request->get('by_theatre'))
            ->by_name($request->get('by_name'))
            ->by_date($request->get('by_day'))
            ->by_time($request->get('by_time'))
            ->get();

        return view('models.posters')->with(['posters' => $p]);
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
        $posters = Poster::query();

        if ($user->theatre_id != 0) {
            $posters = $posters->by_theatre($user->theatre_id);
        }

        $r = [];

        foreach ($posters->get() as $ar) {
            $a = [];
            $a['id'] = $ar->id;
            $a['name'] = $ar->t_perf->perf->name;
            $a['hall'] = $ar->hall->name;
            $a['date'] = $ar->date;
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
        return response()->json(['response' => Poster::findOrFail($id)]);
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
        if (Poster::where([
                ['t_perf_id', '=', $request->get('t_perf_id')],
                ['hall_id', '=', $request->get('hall_id')],
                ['date', '=', Date::createFromFormat('d.m.Y H:i', $request->get('date'))->__toString()]
            ])->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        Poster::create($this->getArgs($request));

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

        $poster = Poster::findOrFail($request->get('id'));

        $poster->update($this->getArgs($request));
        $poster->save();

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

        Poster::destroy($request->get('id'));
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
        return $this->getOnly($request, (new Poster)->getFillable());
    }
}
