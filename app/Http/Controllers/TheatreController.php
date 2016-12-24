<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Interfaces\TController;
use App\T_Hall;
use App\Theatre;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TheatreController extends TController
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
     * @param  int $id
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
    public function all()
    {
        return response()->json(['response' => Theatre::with(['halls'])->get()]);
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
        $theatre = Theatre::with(['halls'])->where('id', ($id == 0 ? $this->getUser()->theatre_id : $id));

        return response()->json(['response' => $theatre->get()->first()]);
    }

    /**
     * Create new element.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Theatre::where('name', $request->get('name'))->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        Theatre::create($this->getOnly($request, ['name', 'desc', 'address', 'tel_num']));

        // Create new halls
        $t_id = Theatre::all()->last()->id;
        $halls = explode(',', $request->get('halls_new'));
        foreach ($halls as $name) {
            $hall = new T_Hall;
            $hall->theatre_id = $t_id;
            $hall->name = $name;
            $hall->json = '{}';
            $hall->save();
        }

        return response()->json(['response' => 'successful']);
    }

    /**
     * Update the specified element/
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $id = $request->get('id');
        $id = $id == 0 ? $this->getUser()->theatre_id : $id;

        $m = Theatre::findOrFail($id);
        $m->update($this->getArgs($request));

        // Create new halls
        $t_id = $this->getUser()->theatre_id;
        $halls = explode(',', $request->get('halls_new'));
        foreach ($halls as $name) {
            $hall = new T_Hall;
            $hall->theatre_id = $t_id;
            $hall->name = $name;
            $hall->json = '{}';
            $hall->save();
        }

        // Delete requested halls
        $halls = explode(',', $request->get('halls_del'));
        foreach ($halls as $hall) {
            T_Hall::destroy($hall);
        }


        return response()->json(['response' => 'successful']);

    }

    /**
     * Remove the specified element.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $m = Theatre::findOrFail($request->get('id'));
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
        return $this->getOnly($request, (new Theatre)->getFillable());
    }
}
