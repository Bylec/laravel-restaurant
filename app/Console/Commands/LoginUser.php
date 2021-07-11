<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class LoginUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $user = User::where('email', 'test@gmail.com')->first();

        $token = $user ? $user->createToken('test_token') : null;

        $this->info(optional($token)->plainTextToken);
    }
}
