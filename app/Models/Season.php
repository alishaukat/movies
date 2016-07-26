<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Season extends Model
{
    protected $table = 'seasons';
    
    /**
    * The episodes that belong to the season.
    */
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    
    /*
     * Number of season for a given filter
     */
    public static function totalSeason($filters=array()){
        $season = self::setFilters($filters);
        return $season->count();
    }
    
    /*
     * Get All Seasons for given filters
     */
    public static function getAll($filters=array('limit'=>8, 'offset'=>0)){
        $season = self::setFilters($filters);
        
        if(!empty($filters['order_by']) && !empty($filters['order_by_type'])){
            $season = $season->orderBy($filters['order_by'], $filters['order_by_type']);
        }
        
        if(!empty($filters['offset'])){
            $season = $season->offset($filters['offset']);
        }
        
        if(!empty($filters['limit'])){
            $season = $season->limit($filters['limit']);
        }
        
        return $season->get();
    }
    
    /*
     * set season filters
     */
    private static function setFilters($filters){        
        $season = new Season();
        
        /* Global Search */
        if(!empty($filters['type']) && $filters['type'] == 'all'){
            $season = $season->where('title', 'like', "%".trim($filters['search'])."%");
            $season = $season->orWhere('genre', 'like', "%".trim($filters['search'])."%");
            $season = $season->orWhere('rating', '=', trim($filters['search']));
            
        } else {
            
            if(!empty($filters['type']) && $filters['type'] == 'title'){
                $season = $season->where('title', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) && $filters['type'] == 'genre'){
                $season = $season->where('genre', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) && $filters['type'] == 'rating'){
                $season = $season->where('rating', 'like', "%".trim($filters['search'])."%");
            }            
        }
        return $season;
    }    
    
}
