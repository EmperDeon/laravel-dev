<?php

namespace App\Http\Controllers;

use App\Article;
use App\Interfaces\TController;
use App\P_Type;
use App\Performance;
use App\Poster;
use App\T_Hall;
use App\T_Performance;
use App\Theatre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UtilsController extends TController
{

    /**
     * [API]
     *
     * Return all rows from tables which are updated since $stamp
     *
     * @param $stamp
     * @return \Illuminate\Http\JsonResponse
     */
    public function updates($stamp) // TODO: Cleanup [Redo to DB class]
    {
        $stamp = Carbon::createFromTimestamp($stamp);

        return response()->json([
//            'actors' => Actor::where('updated_at', '>', $stamp)->get(),
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
     * [API]
     *
     * Return array of pairs [id, name] for ComboBox'es
     *
     * @param $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists($name) // TODO: Refactor after curse !!IMPORTANT!!
    {
        $allowed = ['performances', 'theatres', 'p__types'];
        $allowed_id = ['articles', 'users', 't__performances', 't__halls'];

        if (array_search($name, $allowed) !== false) {
            $a = DB::table($name)->get();
            $r = [];
            foreach ($a as $v) {
                $r[] = ['id' => $v->id, 'name' => $v->name];
            }
            return response()->json(['response' => $r]);

        } else if (array_search($name, $allowed_id) !== false) {
            $user = $this->getUser();

            if ($name == 'users')
                $sql = 'SELECT id, fio AS name FROM users';
            else if ($name == "t__performances")
                $sql = 'SELECT t.id, p.name FROM t__performances AS t LEFT JOIN performances AS p ON t.perf_id=p.id';
            else
                $sql = 'SELECT id, name FROM ' . $name;

            if ($user->theatre_id != 0) {
                $sql .= ' WHERE (theatre_id = ' . $user->theatre_id . ')';
            }

            if ($name == 'users') {
                $sql .= ' AND (login <> \'admin\')';
            }

            $r = DB::select($sql);

            return response()->json(['response' => $r]);

        } else if ($name == 'posters') {
            $user = $this->getUser();

            $sql = 'SELECT r.id, CONCAT(p.name,\' - \',DATE_FORMAT(date, \'%d-%m-%Y %H:%i\'),\' - \',h.name) AS name FROM posters AS r
  JOIN t__performances AS t ON r.t_perf_id=t.id
  JOIN performances AS p ON t.perf_id=p.id
  JOIN t__halls AS h ON r.hall_id=h.id';

            if ($user->theatre_id != 0) {
                $sql .= ' WHERE t.theatre_id = ' . $user->theatre_id;
            }

            $r = DB::select($sql);

            return response()->json(['response' => $r]);

        } else if ($name == 'u__perms') {
            $sql = 'SELECT id, name FROM u__perms WHERE (name NOT LIKE \'theatre%\') AND (name NOT LIKE \'actor%\')';
            $r = DB::select($sql);

            return response()->json(['response' => $r]);

        } else {
            return response()->json(['error' => 'no_such_table']);
        }
    }

    /**
     * [API]
     *
     * If current user is admin, change theatre_id to $id from request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change(Request $request)
    {
        $user = $this->getUser();

        if ($user->login != 'admin')
            return response()->json(['error' => 'no_access']);

        if (!$request->has('id'))
            return response()->json(['error' => 'no_id']);

        $user->theatre_id = $request->get('id');
        $user->save();

        return response()->json(['response' => 'successful']);
    }
}
