<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
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
    public function seriesListing(Request $request){
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
    public function showSeries($url)
    {
        $series = Series::where('url', $url)->first();
        if(empty($series)){
            abort(404, 'Invalid URL');
        }
        $seasons        = $series->seasons;
        $seasons_list   = view('partials.seasons_list', compact('seasons'));
        return view('series_detail', compact('series', 'seasons_list'));
    }
    
    /**
     * Returns a list of seasons with ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function seasonsListing(Request $request){
        $filters        = $request->all();
        $seasons        = Season::getAll($filters);
        $seasons_list   = view('partials.seasons_list', compact('seasons'));
        $response   = [
            'status'=> 'success',
            'data'  => $seasons_list->render()
        ];
        return json_encode($response);
    }
    
    /**
     * Display the specified season.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSeason($url)
    {
        $season = Season::where('url', $url)->first();
        if(empty($season)){
            abort(404, 'Invalid URL');
        }
        $episodes       = $season->episodes;
        $episodes_list   = view('partials.episodes_list', compact('episodes'));
        return view('season_detail', compact('season', 'episodes_list'));
    }
    
    /**
     * Display the specified episode.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEpisode($url)
    {
        $episode = Episode::where('url', $url)->first();
        if(empty($episode)){
            abort(404, 'Invalid URL');
        }
        return view('episode_detail', compact('episode'));
    }
}
