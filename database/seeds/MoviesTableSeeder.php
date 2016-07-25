<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $genre = ["fantasy", "fiction","romance"];
            for($i = 0; $i < 500; $i++){
            $faker = Faker\Factory::create();
            DB::table('movies')->insert([
                'title'        => $faker->name,
                'genre'        => $genre[rand(0,2)],
                'rating'       => rand(1,5),
                'summary'      => $faker->text(rand(100,1000)),
                'url'          => $faker->slug,
                'image_url'    => "http://placehold.it/700x400",
                'video_url'    => "https://youtu.be/s7L2PVdrb_8",
                'created_at'   => date("Y-m-d H:i:s", rand(1464199495,time())),
                'updated_at'   => date('Y-m-d H:i:s')
            ]);
        }
    }
}
