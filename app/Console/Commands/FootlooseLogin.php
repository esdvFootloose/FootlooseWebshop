<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class FootlooseLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:footloose 
    {username : The footloose username} 
    {password : The password for the provided username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Login using Footloose login credentials';

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
        $user = $this->argument('username');
        $password = $this->argument('password');

        $current_path = base_path();
        $process = new Process("cd {$current_path} && cd ../html && php api-ext-auth.php {$user} {$password}");

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->json_decode($process->getOutput());
    }
}
