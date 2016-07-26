<?php

use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre = ["fantasy", "fiction","romance"];
        for($i = 0; $i < 100; $i++){
            $faker = Faker\Factory::create();
            DB::table('series')->insert([
                'title'        => $faker->name,
                'genre'        => $genre[rand(0,2)],
                'rating'       => rand(1,5),
                'summary'      => $faker->text(rand(100,1000)),
                'url'          => $faker->slug,
                'image_url'    => "http://placehold.it/700x400",
                'video_url'    => "http://www.sample-videos.com/video/mp4/720/big_buck_bunny_720p_50mb.mp4",
                'created_at'   => date("Y-m-d H:i:s", rand(1464199495,time())),
                'updated_at'   => date('Y-m-d H:i:s')
            ]);
        }
    }
}
