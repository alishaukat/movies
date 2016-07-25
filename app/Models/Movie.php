<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Movie extends Model
{
    protected $table = 'movies';
    
    /*
     * Number of movies for a given filter
     */
    public static function totalMovies($filters=array()){
        $movies = self::setFilters($filters);
        return $movies->count();
    }
    
    /*
     * Get All Movies for given filters
     */
    public static function getAll($filters=array('limit'=>8, 'offset'=>0)){
        $movies = self::setFilters($filters);
        
        if(!empty($filters['order_by']) && !empty($filters['order_by_type'])){
            $movies = $movies->orderBy($filters['order_by'], $filters['order_by_type']);
        }
        
        if(!empty($filters['offset'])){
            $movies = $movies->offset($filters['offset']);
        }
        
        if(!empty($filters['limit'])){
            $movies = $movies->limit($filters['limit']);
        }
        
        return $movies->get();
    }
    
    /*
     * set movie filters
     */
    private static function setFilters($filters){        
        $movies = new Movie();
        
        /* Global Search */
        if(!empty($filters['type']) && $filters['type'] == 'all'){
            $movies = $movies->where('title', 'like', "%".trim($filters['search'])."%");
            $movies = $movies->orWhere('genre', 'like', "%".trim($filters['search'])."%");
            $movies = $movies->orWhere('rating', '=', trim($filters['search']));
            
        } else {
            
            if(!empty($filters['type']) == 'title'){
                $movies = $movies->where('title', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) == 'genre'){
                $movies = $movies->where('genre', 'like', "%".trim($filters['search'])."%");
            }
            if(!empty($filters['type']) == 'rating'){
                $movies = $movies->where('rating', '=', trim($filters['search']));
            }            
        }
        return $movies;
    }    
    
}
