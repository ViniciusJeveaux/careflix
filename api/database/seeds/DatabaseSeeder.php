<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // App\User::truncate();
        // App\Show::truncate();
        // App\ShowGroup::truncate();
        // App\ShowVideo::truncate();

        $faker = Faker::create();

        App\User::create([
            'name' => $faker->name,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'is_admin' => true
        ]);

        App\User::create([
            'name' => $faker->name,
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'is_admin' => false
        ]);

        $this->command->info('Created sample users [admin@admin.com] & [user@user.com]');

        // foreach(range(0, 10) as $i) {
        //     $is_movie = $i < 5;

        //     $title_type = $is_movie ? 'movie' : 'series';

        //     $this->command->info(sprintf('Seeding `shows` table [%s] (%s / %s)', $title_type, $i + 1, 10));

        //     $show = App\Show::create([
        //         'title' => $is_movie ? 'Avengers: Endgame' : 'Brooklyn Nine-Nine',
        //         'title_type' => $title_type,
        //         'synopsis' => $faker->text,
        //         'language' => 'English',
        //         'air_start' => Carbon::create(2000 + $i, 0, 0),
        //         'air_end' => $is_movie ? null : Carbon::create(2000 + $i + 1, 0, 0),
        //         'age_rating' => '13+',
        //         'preview_image' => 'https://caretv.sgp1.cdn.digitaloceanspaces.com/videos/big-buck-bunny/thumbnail.png'
        //     ]);

        //     if ($is_movie) {
        //         App\ShowVideo::create([
        //             'show_id' => $show->id,
        //             'video_url' => 'https://caretv.sgp1.cdn.digitaloceanspaces.com/videos/big-buck-bunny/big-buck-bunny.mp4',
        //             'duration' => 596,
        //             'synopsis' => $faker->text,
        //         ]);
        //     } else {
        //         foreach (range(0, 2) as $j) {
        //             $group = App\ShowGroup::create([
        //                 'show_id' => $show->id,
        //                 'title' => sprintf("Season %s", $j + 1)
        //             ]);

        //             foreach(range(0, 5) as $k) {
        //                 App\ShowVideo::create([
        //                     'show_id' => $show->id,
        //                     'show_group_id' => $group->id,
        //                     'title' => sprintf("Episode %s", $k),
        //                     'video_url' => 'https://caretv.sgp1.cdn.digitaloceanspaces.com/videos/big-buck-bunny/big-buck-bunny.mp4',
        //                     'duration' => 596,
        //                     'synopsis' => $faker->text,
        //                     'preview_image' => 'https://caretv.sgp1.cdn.digitaloceanspaces.com/videos/big-buck-bunny/thumbnail.png'
        //                 ]);
        //             }
        //         }
        //     }
        // }

        // //////////////////////////////////
        // Create random users for search
        // //////////////////////////////////
        foreach(range(0, 49) as $i) {
            $this->command->info("Seeding users table ({$i + 1} / 50)");

            $user = App\User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' => 'password',
                'remember_token' => Str::random(10),
                'is_admin' => false
            ]);
        }
    }
}
