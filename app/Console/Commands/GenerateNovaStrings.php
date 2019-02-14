<?php

namespace App\Console\Commands;

use App\Enums\Locale;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
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
     * @var Collection
     */
    protected $translations;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        collect(Locale::codes())->each(function ($language) {
            $this->translations = collect();
            $path = resource_path("lang/vendor/nova/{$language}.json");

            $this->mergeBaseTranslations($language);
            $this->generatePackageStrings($language);
            $this->generateGlobalStrings($language);

            file_put_contents($path, $this->translations->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->info("{$path} was generated.");
        });
    }

    private function mergeBaseTranslations($language)
    {
        $translationFile = resource_path('lang/vendor/nova/base/'.$language.'.json');
        $translations = is_readable($translationFile) ? json_decode(file_get_contents($translationFile), true) : [];

        $this->translations = $this->translations->merge($translations);
    }

    private function generatePackageStrings($language)
    {
        $packages = $this->fetchPackageDirectories();

        foreach ($packages as $package) {
            $this->generateStringsBasedOnPath("{$package}/resources/lang/{$language}", $package);
        }
    }

    private function generateGlobalStrings($language)
    {
        $this->generateStringsBasedOnPath(resource_path("lang/{$language}"));
    }

    private function fetchPackageDirectories()
    {
        $path = realpath(base_path('nova-components'));

        return glob("{$path}/*", GLOB_ONLYDIR);
    }

    private function generateStringsBasedOnPath($path, $directory = null)
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

        $this->translations = $this->translations->merge($translations);
    }
}
