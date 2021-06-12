<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
class SetupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup project in local system, Run migration, seeder';

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
        Artisan::call('key:generate');
        Artisan::call('migrate');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('db:seed --class=RoleTableSeeder');
    }
}
