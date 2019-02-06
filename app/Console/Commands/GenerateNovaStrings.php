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
        foreach ($packageDirectories as $directory) {
            $path = "{$directory}/resources/lang/{$language}";

            $this->generateStringsBasedOnPath($path, $directory);
        }
    }

    private function generateGlobalStrings($language)
    {
        $path = resource_path("lang/{$language}");
        $pathToStore = resource_path("lang/vendor/nova");

        $this->generateStringsBasedOnPath($path, null, $pathToStore);
    }

    private function fetchPackageDirectories()
    {
        $path = realpath(base_path('nova-components'));

        return glob("{$path}/*", GLOB_ONLYDIR);
    }

    private function generateStringsBasedOnPath($path, $directory = null, $pathToStore = null)
    {
        $translations = collect([]);
        $package = $directory ? kebab_case(last(explode('/', $directory))) : null;

        if (File::exists($path)) {
            $files = File::files($path);

            collect($files)->flatMap(function ($file) use (&$translations, $package) {
                $file = $file->getBasename('.php');
                $file = $package ? "{$package}::{$file}" : $file;
                $translations = $translations->merge(collect(trans($file)));
            });
        }

        if ($translations->isNotEmpty()) {
            $pathToStore = $pathToStore ? $pathToStore . '/' . last(explode('/', $path)) : $path;
            file_put_contents("$pathToStore.json", $translations->toJson(JSON_PRETTY_PRINT));
            $this->info("{$pathToStore}.json was generated.");
        }
    }
}
