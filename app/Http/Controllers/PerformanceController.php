<?php

namespace App\Http\Controllers;

use App\T_Performance;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Get all elements for web.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->has('by_type')){
            $p = T_Performance::by_type($request->get('by_type'))->get();
        }else{
            $p = T_Performance::all();
        }

        return view('models.perfs')->with(['perfs' => $p]);
    }

    /**
     * Display the specified element.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('models.perf')->with(['perf' => T_Performance::findOrFail($id)]);
    }

    /**
     * Get all elements in json
     *
     * @return string
     */
    public function all () {
        return T_Performance::with(['halls'])->get();
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
