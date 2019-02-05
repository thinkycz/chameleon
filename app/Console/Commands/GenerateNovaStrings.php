<?php

namespace App\Console\Commands;

use App\Enums\Locale;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateNovaStrings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'strings:generate';

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
        $packageDirectories = $this->fetchPackageDirectories();

        collect(Locale::codes())->each(function ($language) use ($packageDirectories) {
            $this->generatePackageStrings($language, $packageDirectories);
            $this->generateGlobalStrings($language);
        });
    }

    private function generatePackageStrings($language, $packageDirectories)
    {
        $content = '';

        foreach ($packageDirectories as $directory) {
            $path = "{$directory}/resources/lang/{$language}";

            $this->generateStringsBasedOnPath($path);
        }
    }

    private function generateGlobalStrings($language)
    {
        $path = resource_path("lang/{$language}");

        $this->generateStringsBasedOnPath($path);
    }

    private function fetchPackageDirectories()
    {
        $path = realpath(base_path('nova-components'));

        return glob("{$path}/*", GLOB_ONLYDIR);
    }

    private function generateStringsBasedOnPath($path)
    {
        $translations = collect([]);

        if (File::exists($path)) {
            $files = File::files($path);

            collect($files)->flatMap(function ($file) use (&$translations) {
                $file = $file->getBasename('.php');
                $translations = $translations->merge(trans($file));
            });
        }

        if ($translations->isNotEmpty()) {
            file_put_contents("$path.json", $translations->toJson(JSON_PRETTY_PRINT));
            $this->info("{$path}.json was generated.");
        }
    }
}