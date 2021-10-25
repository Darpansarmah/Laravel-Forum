<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Channel::create([

            'name'=>'Laravel 7',
            'slug'=>str::slug('Laravel 7', '-')

        ]);

        Channel::create([

            'name'=>'Vue js 3',
            'slug'=>str::slug('Vue js 3', '-')

        ]);

        Channel::create([

            'name'=>'Angular 7',
            'slug'=>str::slug('Angular 7', '-')

        ]);

        Channel::create([

            'name'=>'Node js',
            'slug'=>str::slug('Node js', '-')

        ]);

    }
}
