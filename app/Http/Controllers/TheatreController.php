<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Theatre;

class TheatreController extends Controller
{
    /**
     * Get all elements for web.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('models.theatres')->with(['theatres' => Theatre::all()]);
    }

    /**
     * Display the specified element.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('models.theatre')->with(['theatre' => Theatre::findOrFail($id)]);
    }

    /**
     * Get all elements in json
     *
     * @return string
     */
    public function all () {
        return response()->json(['response' => Theatre::with(['halls'])->get()]);
    }

    /**
     * Create new element.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Theatre::where('name', $request->get('name'))->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        Theatre::create($this->getOnly($request, ['name', 'desc', 'img', 'address', 'tel_num']));
        return response()->json(['response' => 'successful']);
    }

    /**
     * Update the specified element/
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        try {
            $m = Theatre::findOrFail($request->get('id'));
            $m->update($this->getOnly($request, ['name', 'desc', 'img', 'address', 'tel_num']));
            return response()->json(['response' => 'successful']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'id_not_exists']);

        }
    }

    /**
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

        try {
            $m = Theatre::findOrFail($request->get('id'));
//            $m->delete();
            return response()->json(['response' => 'successful']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'id_not_exists']);

        }
    }

    /**
     * @param Request $request
     * @param array $n
     * @return array
     */
    public function getOnly(Request $request, array $n):array
    {
        $r = [];

        foreach($n as $v)
            if($request->has($v))
                $r[$v] = $request->get($v);

        return $r;
    }
}
