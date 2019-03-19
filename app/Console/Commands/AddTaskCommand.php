<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddTaskCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'app:add-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new dummy task.';

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
        Task::create([
            'name' => 'Dummy Task',
            'description' => 'Task added on ' . Carbon::now()
        ]);
    }
}
