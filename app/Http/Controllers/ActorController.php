<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Get all elements for web.
     *
     * @return string
     */
    public function index()
    {
        return 'Sorry, nothing here yet';
    }

    /**
     * Display the specified element.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('models.actor')->with(['actor' => Actor::findOrFail($id)]);
    }

    /**
     * Get all elements in json
     *
     * @return string
     */
    public function all()
    {
        return response()->json(['response' => Actor::all()]);
    }

    /**
     * Create new element.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        Theatre::create($request->only(['name', 'desc', 'img', 'address', 'tel_num']));

        return response()->json(['result' => 'successful']);
    }

    /**
     * Update the specified element/
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json();
    }

    /**
     * Remove the specified element.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json();
    }
}
