<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Movies extends Model
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
     * Get All Movies for given filters and limit
     */
    public static function getAll($offset=0, $limit=8, $filters=array()){
        $movies = self::setFilters($filters);
        if(!empty($filters['order_by']) && !empty($filters['order_by_type'])){
            $movies = $movies->orderBy($filters['order_by'], $filters['order_by_type']);
        }
        if(!empty($offset)){
            $movies = $movies->offset($offset);
        }
        if(!empty($limit)){
            $movies = $movies->limit($limit);
        }
        return $movies->get();
    }
    
    /*
     * set movie filters
     */
    private static function setFilters($filters){        
        $movies = new Movies();
        
        /* Global Search */
        if(!empty($filters['all'])){
            $movies = $movies->where('title', 'like', "%".trim($filters['title'])."%");
            $movies = $movies->orWhere('genre', 'like', "%".trim($filters['genre'])."%");
            $movies = $movies->orWhere('rating', '=', trim($filters['rating']));
            
        } else {
            
            if(!empty($filters['title'])){
                $movies = $movies->where('title', 'like', "%".trim($filters['title'])."%");
            }
            if(!empty($filters['genre'])){
                $movies = $movies->where('genre', 'like', "%".trim($filters['genre'])."%");
            }
            if(!empty($filters['rating'])){
                $movies = $movies->where('rating', '=', trim($filters['rating']));
            }            
        }
        return $movies;
    }    
    
}
