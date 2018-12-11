<?php

use Illuminate\Database\Seeder;
use App\Helpers\Helper;

class FileGeneratorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filepath = __DIR__.'/../files/countries.json';
        $destination =  __DIR__.'/../files/countries.php';
        $node = 'countries';
        $helper = new Helper;
        $helper->writeJsonToFileAsArray($filepath, $destination, $node);

        $filepath = __DIR__.'/../files/states.json';
        $destination =  __DIR__.'/../files/states.php';
        $node = 'states';
        $helper->writeJsonToFileAsArray($filepath, $destination, $node);
    }
}
