<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Greeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'greeting:greet {name} {--formal}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renders out a greeting on the command line';

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
        if ($this->option('formal')) {
            return $this->info($this->getFormalGreeting() . $this->argument('name'));
        }
        return $this->info('Hello ' . $this->argument('name'));
    }

    /**
     * Formal Greeting
     *
     * @return string
     */
    protected function getFormalGreeting()
    {
        if (date('H') < 12) {
            return 'Good Morning ';
        }
        if (date('H') < 17) {
            return 'Good afternoon ';
        }
        return 'Good Evening ';
    }
}
