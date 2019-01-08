<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\V1\Organization;
use App\Helpers\Helper;

class NginxDaemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nginx:daemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nginx Daemon that creates and edits nginx file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
     $organization = ['something.com'];//Organization::all()->pluck('domain_name');  
     $path = __DIR__."/";
     $filename = $organization[0].".conf";
     $created = Helper::createNginxConfig($path, $filename, $organization);
     $container = env('CONTAINER_NAME');

     $command = "docker exec $container bash -c 'php artisan migrate --path=database/migrations/v1 --seed && mv app/Console/Commands/$filename /etc/nginx/sites-available && ln -s /etc/nginx/sites-available/$filename /etc/nginx/sites-enabled/$filename'";
    
    $result = shell_exec($command);
    info($result);
    }
}
