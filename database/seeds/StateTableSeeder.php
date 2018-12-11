<?php

use Illuminate\Database\Seeder;
use App\Model\V1\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = require __DIR__.'/../files/states.php';
       
        State::truncate('states');

        State::insert($states);
    }
}
