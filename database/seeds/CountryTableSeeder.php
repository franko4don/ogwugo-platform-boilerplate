<?php

use Illuminate\Database\Seeder;
use App\Model\V1\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $countries = require __DIR__.'/../files/countries.php';
       
        Country::truncate('countries');
        Country::insert($countries);
    }

}
