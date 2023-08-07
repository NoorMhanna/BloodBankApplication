<?php

namespace App\Console\Commands;

use App\Models\admin;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class stratProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // Artisan::call('migrate:fresh');
        // $this->info('databade migrated');
        // Artisan::call('db:seed');
        $this->info('crete tour owan account , follow steps:');
        $name = $this->ask('enter email');
        $pass = $this->ask('enter pass');
        User::create([
            'name'=>$name ,
            'password'=>$pass ,
        ]);
        $this->info('your account created SUCCESSFUL ');
        return Command::SUCCESS ;
    }
}
