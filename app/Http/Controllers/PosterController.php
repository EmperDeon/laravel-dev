<?php

namespace App\Http\Controllers;

use App\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
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
     * Get all elements in json
     *
     * @return string
     */
    public function all()
    {
        return Poster::with(['halls'])->get();
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
