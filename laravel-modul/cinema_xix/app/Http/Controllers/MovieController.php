<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $movies = Movie::latest()->get();
        return view("movie.index", compact("movies", "index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("movie.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // movie store
        $data = $request->validate([
            "name" => "required",
            "minute_length" => "required",
            "picture_url" => "required",
        ]);

        // upload file picture url
        $file = $request->file("picture_url");
        $fileName = time() . "_" . $file->getClientOriginalName();
        $file->move("storage/pictures_movies", $fileName);

        $data["picture_url"] = $fileName;

        Movie::create($data);
        return redirect("admin/movie")->with("success", "Movie created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view("movie.create", compact("movie"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        // movie update
        $data = $request->validate([
            "name" => "required",
            "minute_length" => "required",
            "picture_url" => "nullable",
        ]);

        // upload file picture url
        $file = $request->file("picture_url");
        if($file)
        {
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->move("storage/pictures_movies", $fileName);
            $data["picture_url"] = $fileName;
        }

        $movie->update($data);
        return redirect("admin/movie")->with("success", "Movie updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        unlink("storage/pictures_movies/" . $movie->picture_url);
        $movie->delete();

        return redirect("admin/movie")->with("success", "Movie deleted successfully.");
    }
}
