<?php

namespace App\Console\Commands;

use App\Enums\Locale;
use Illuminate\Console\Command;

class GenerateNovaStrings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nova:generate-strings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates strings for Nova and Nova Packages.';

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
        $languages = collect(Locale::codes())->each(function ($language) {
            $this->generate($language);
        });
    }

    private function generate()
    {
        //
    }
}
