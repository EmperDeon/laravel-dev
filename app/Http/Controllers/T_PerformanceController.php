<?php

namespace App\Http\Controllers;

use App\Poster;
use App\T_Performance;
use Illuminate\Http\Request;

class T_PerformanceController extends Controller
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
     * Get all elements in json
     *
     * @return string
     */
    public function all()
    {
        return T_Performance::with(['halls'])->get();
    }


}
