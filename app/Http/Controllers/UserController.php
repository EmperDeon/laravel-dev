<?php

namespace App\Http\Controllers;

use App\Interfaces\TController;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends TController
{
    /**
     * Get all elements in json
     *
     * @return string
     */
    public function all()
    {
        $user = $this->getUser();
        if ($user->theatre_id == 0) {
            $users = User::with(['perms']);
        } else {
            $users = User::with(['perms'])->where('theatre_id', $user->theatre_id);
        }

        return response()->json(['response' => $users->get()]);
    }

    /**
     * Create new element.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('name', $request->get('name'))->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        User::create($this->getOnly($request, ['name', 'desc', 'address', 'tel_num']));
        return response()->json(['response' => 'successful']);
    }

    /**
     * Update the specified element/
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        try {
            $m = User::findOrFail($request->get('id'));
            $m->update($this->getOnly($request, ['fio', 'position', 'login', 'phone']));

            return response()->json(['response' => 'successful']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'id_not_exists']);

        }
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

        try {
            $m = User::findOrFail($request->get('id'));
//            $m->delete();
            return response()->json(['response' => 'successful']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'id_not_exists']);

        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param array $n
     * @return array
     */
    public function getOnly(Request $request, array $n):array
    {
        $r = [];

        foreach ($n as $v)
            if ($request->has($v))
                $r[$v] = $request->get($v);

        return $r;
    }
}
