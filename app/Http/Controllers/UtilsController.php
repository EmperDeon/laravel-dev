<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Article;
use App\P_Type;
use App\Performance;
use App\Poster;
use App\T_Hall;
use App\T_Performance;
use App\Theatre;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UtilsController extends Controller
{

    /**
     * @param $stamp
     * @return \Illuminate\Http\JsonResponse
     */
    public function updates($stamp)
    {
        $stamp = Carbon::createFromTimestamp($stamp);

        return response()->json([
            'actors' => Actor::where('updated_at', '>', $stamp)->get(),
            'articles' => Article::where('updated_at', '>', $stamp)->get(),
            'p_types' => P_Type::where('updated_at', '>', $stamp)->get(),
            'performances' => Performance::where('updated_at', '>', $stamp)->get(),
            'posters' => Poster::where('updated_at', '>', $stamp)->get(),
            't_halls' => T_Hall::where('updated_at', '>', $stamp)->get(),
            't_performances' => T_Performance::where('updated_at', '>', $stamp)->get(),
            'theatres' => Theatre::where('updated_at', '>', $stamp)->get()
        ]);
    }

    /**
     * @param $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists($name)
    {
        $allowed = ['u__perms'];

        if (array_search($name, $allowed) !== false) {
            $a = DB::table($name)->get();
            $r = [];
            foreach ($a as $v) {
                $r[] = ['id' => $v->id, 'name' => $v->name];
            }
            return response()->json(['response' => $r]);
        } else {

        return response()->json(['error' => 'no_such_table']);
    }
    }
}
