<?php

namespace App\Http\Controllers;

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
        return Theatre::with(['halls'])->get();
    }

    /**
     * Create new element.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json();
    }

    /**
     * Update the specified element/
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json();
    }

    /**
     * Remove the specified element.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json();
    }
}
