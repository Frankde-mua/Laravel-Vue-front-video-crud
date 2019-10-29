<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movies;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Allmovies()
    {
        // $movie = Movies::all();

        // return response()->json(
        //     [
        //         'status' => 'success',
        //         'movie' => $movie->toArray()
        //     ], 200);
            $movie             = Movies::select('id', 'name', 'genre')
            ->orderBy('id', 'desc')
            ->get();
        return $movie;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $movie = new Movies();
        $movie->genre = $request->vgenre;
        $movie->name = $request->vname;
        $movie->save();
    }

    public function store(Request $request)
    {
        $movie = Movies::create($request->all());
        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movies::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $movie = Movies::findOrFail($id);
        $movie->update($request->all());

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movies::findOrFail($id);
        $movie->delete();
        return '';
    }
}
