<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Interfaces\TController;
use Illuminate\Http\Request;

class ActorController extends TController
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
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('models.actor')->with(['actor' => Actor::findOrFail($id)]);
    }

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
        if ($user->theatre_id == 0) {
            $actors = Actor::all();
        } else {
            $actors = Actor::where('theatre_id', $user->theatre_id)->get();
        }

        return response()->json(['response' => $actors]);
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
        return response()->json(['response' => Actor::findOrFail($id)]);
    }

    /**
     * [API]
     *
     * Create new element.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (Actor::where('name', $request->get('name'))->count() > 0)
            return response()->json(['error' => 'entry_exists']);

        Actor::create($this->getArgs($request));

        $actor = Actor::all()->last();
        $actor->theatre_id = $this->getUser()->theatre_id;
        $actor->save();

        return response()->json(['response' => 'successful']);
    }

    /**
     * [API]
     *
     * Update the specified element.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $actor = Actor::findOrFail($request->get('id'));

        $actor->update($this->getArgs($request));
        $actor->save();

        return response()->json(['response' => 'successful']);
    }

    /**
     * [API]
     *
     * Remove the specified element.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'no_id']);
        }

        $m = Actor::findOrFail($request->get('id'));
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
        return $this->getOnly($request, (new Actor)->getFillable());
    }
}
