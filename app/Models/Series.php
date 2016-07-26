<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Series extends Model
{
    protected $table = 'series';
    
    /**
    * The seasons that belong to the series.
    */
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
    
    /*
     * Number of series for a given filter
     */
    public static function totalSeries($filters=array()){
        $series = self::setFilters($filters);
        return $series->count();
    }
    
    /*
     * Get All Series for given filters
     */
    public static function getAll($filters=array('limit'=>8, 'offset'=>0)){
        $series = self::setFilters($filters);
        
        if(!empty($filters['order_by']) && !empty($filters['order_by_type'])){
            $series = $series->orderBy($filters['order_by'], $filters['order_by_type']);
        }
        
        if(!empty($filters['offset'])){
            $series = $series->offset($filters['offset']);
        }
        
        if(!empty($filters['limit'])){
            $series = $series->limit($filters['limit']);
        }
        
        return $series->get();
    }
    
    /*
     * set series filters
     */
    private static function setFilters($filters){        
        $series = new Series();
        
        /* Global Search */
        if(!empty($filters['type']) && $filters['type'] == 'all'){
            $series = $series->where('title', 'like', "%".trim($filters['search'])."%");
            $series = $series->orWhere('genre', 'like', "%".trim($filters['search'])."%");
            $series = $series->orWhere('rating', '=', trim($filters['search']));
            
        } else {
            
            if(!empty($filters['type']) && $filters['type'] == 'title'){
                $series = $series->where('title', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) && $filters['type'] == 'genre'){
                $series = $series->where('genre', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) && $filters['type'] == 'rating'){
                $series = $series->where('rating', 'like', "%".trim($filters['search'])."%");
            }            
        }
        return $series;
    }    
    
}
