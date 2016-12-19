<?php

namespace App\Http\Controllers;

use App\Interfaces\TController;
use App\Interfaces\TS;
use App\U_Perm;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends TController
{
    /**
     * [API]
     *
     * Get all elements in json
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $user = $this->getUser();
        $users = User::with(['perms']);

        if ($user->theatre_id != 0) {
            $users = $users->where('theatre_id', $user->theatre_id);

        }

        return response()->json(['response' => $users->get()]);
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
        $u = User::findOrFail($id);
        $r = $u->toJson();
        $r = json_decode($r);

        $perms = [];
        foreach ($u->perms as $perm)
            $perms[] = $perm->id;

        $r->perms = implode(',', $perms);

        return response()->json(['response' => $r]);
    }

    /**
     * [API]
     *
     * Create new element.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('login', $request->get('login'))->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        User::create($this->getArgs($request));

        $user = User::all()->last();
        $user->theatre_id = $this->getUser()->theatre_id;
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $perms = explode(',', $request->get('perms'));
        foreach ($perms as $p_id) {
            DB::table('user__perms')->insert(['user_id' => $user->id, 'perm_id' => $p_id]);
        }

        return response()->json(['response' => 'successful']);
    }

    /**
     * [API]
     *
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
            $user = User::findOrFail($request->get('id'));
            $user->update($this->getArgs($request));

            if (($t = $request->get('password')) && $t != '')
                $user->password = Hash::make($t);

            if ($request->has('perms')) {
                DB::delete('DELETE FROM user__perms WHERE user_id = ' . $user->id);
                foreach (explode(',', $request->get('perms')) as $p_id) {
                    DB::table('user__perms')->insert(['user_id' => $user->id, 'perm_id' => $p_id]);
                }
            }

            $user->save();

            return response()->json(['response' => 'successful']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'id_not_exists']);

        }
    }

    /**
     * [API]
     *
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

        $m = User::findOrFail($request->get('id'));
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
        return $this->getOnly($request, (new User)->getFillable());
    }
}
