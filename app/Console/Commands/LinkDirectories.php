<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class LinkDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:directories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates missing symlinks';

    /**
     * Create a new command instance.
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
        $this->symlink(storage_path('app/public'), public_path('storage'));
        $this->symlink(resource_path('images'), public_path('images'));
        $this->symlink(resource_path('fonts'), public_path('fonts'));

        return;
    }

    private function symlink($from, $to)
    {
        if (!File::exists($from)) {
            File::makeDirectory($from, 0755, true);
        }

        if (file_exists($to)) {
            File::delete($to);
        }

        File::makeDirectory($to, 0755, true);

        File::deleteDirectory($to);

        File::link($from, $to);

        $this->info("The {$to} directory has been linked.");
    }
}
