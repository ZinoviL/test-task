<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Film;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    /**
     * Returns list of films.
     *
     * @return Builder[]|Collection
     */
    public function list()
    {
        return Film::with(['genre', 'actors'])->get();
    }

    /**
     * Returns specified film.
     *
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function show($id)
    {
        return Film::with(['genre', 'actors'])->findOrFail($id);
    }

    /**
     * Create new film.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'genre_id' => ['required', 'exists:genres,id']
        ]);

        if ($validator->fails()) {
            abort(400);
        }

        $film = new Film;
        $film->fill($request->all());
        $film->save();

        if ($request->input('actors')) {
            $actors = Actor::find($request->input('actors'));
            if ($actors) {
                $film->actors()->attach($actors);
                $film->save();
            }
        }

        abort(200);
    }

    /**
     * Update specified film.
     *
     * @param Request $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'genre_id' => ['nullable', 'exists:genres,id']
        ]);

        if ($validator->fails()) {
            abort(400);
        }

        $film = Film::findOrFail($id);
        $film->fill($request->all());

        if ($request->input('actors')) {
            $actors = Actor::find($request->input('actors'));
            if ($actors) {
                $film->actors()->detach();
                $film->actors()->attach($actors);
            }
        }

        $film->save();

        abort(200);
    }

    /**
     * Delete specified film.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        abort(200);
    }
}
