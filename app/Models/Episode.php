<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Episode extends Model
{
    protected $table = 'episodes';
    
    /**
    * The episodes that belong to the episode.
    */
    public function episodes()
    {
        return $this->hasMany('App\Models\Episode');
    }
    
    /*
     * Number of episode for a given filter
     */
    public static function totalEpisode($filters=array()){
        $episode = self::setFilters($filters);
        return $episode->count();
    }
    
    /*
     * Get All Episodes for given filters
     */
    public static function getAll($filters=array('limit'=>8, 'offset'=>0)){
        $episode = self::setFilters($filters);
        
        if(!empty($filters['order_by']) && !empty($filters['order_by_type'])){
            $episode = $episode->orderBy($filters['order_by'], $filters['order_by_type']);
        }
        
        if(!empty($filters['offset'])){
            $episode = $episode->offset($filters['offset']);
        }
        
        if(!empty($filters['limit'])){
            $episode = $episode->limit($filters['limit']);
        }
        
        return $episode->get();
    }
    
    /*
     * set movie filters
     */
    private static function setFilters($filters){        
        $episode = new Episode();
        
        /* Global Search */
        if(!empty($filters['type']) && $filters['type'] == 'all'){
            $episode = $episode->where('title', 'like', "%".trim($filters['search'])."%");
            $episode = $episode->orWhere('genre', 'like', "%".trim($filters['search'])."%");
            $episode = $episode->orWhere('rating', '=', trim($filters['search']));
            
        } else {
            
            if(!empty($filters['type']) && $filters['type'] == 'title'){
                $episode = $episode->where('title', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) && $filters['type'] == 'genre'){
                $episode = $episode->where('genre', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) && $filters['type'] == 'rating'){
                $episode = $episode->where('rating', 'like', "%".trim($filters['search'])."%");
            }            
        }
        return $episode;
    }    
    
}
