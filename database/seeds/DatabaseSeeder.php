<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(SeriesTableSeeder::class);
        $this->call(SeasonsTableSeeder::class);
        $this->call(EpisodesTableSeeder::class);
        
        Model::reguard();
    }
}
