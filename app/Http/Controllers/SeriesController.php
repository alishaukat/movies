<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    /**
     * Display a listing of the series.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = [
            'limit'         => 8,
            'offset'        => 0,
            'order_by'      => 'title',
            'order_by_type' => 'asc',
//            'type'          => 'title',
//            'search'        => 'Agn'
        ];

        $series = Series::getAll($filters);
        $series_list = view('partials.series_list', compact('series'));
        return view('series', compact('series_list'));
    }

    /**
     * Returns a list of series with ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request){
        $filters    = $request->all();
        $series     = Series::getAll($filters);
        $series_list= view('partials.series_list', compact('series'));
        $response   = [
            'status'=> 'success',
            'data'  => $series_list->render()
        ];
        return json_encode($response);
    }

    /**
     * Display the specified series.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $series = Series::where('url', $url)->first();
        if(empty($series)){
            abort(404, 'Invalid URL');
        }
        return view('series_detail', compact('series'));
    }
    
}
