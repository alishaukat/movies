<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Controllers\Controller;

class MoviesController extends Controller
{
    /**
     * Display a listing of the movies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = [
            'limit'         => 8,
            'offset'        => 0,
            'order_by'      => 'title',
            'order_by_type' => 'asc'
        ];

        $movies = Movie::getAll($filters);
        $movies_list = view('partials.movies_list', compact('movies'));
        return view('movies', compact('movies_list'));
    }

    /**
     * Returns a list of movies with ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request){
        $filters    = $request->all();
        $movies     = Movie::getAll($filters);
        $movies_list= view('partials.movies_list', compact('movies'));
        $response   = [
            'status'=> 'success',
            'data'  => $movies_list->render()
        ];
        return json_encode($response);
    }

    /**
     * Display the specified movie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $movie = Movie::where('url', $url)->first();
        if(empty($movie)){
            abort(404, 'Invalid URL');
        }
        return view('movie_detail', compact('movie'));
    }
    
}
