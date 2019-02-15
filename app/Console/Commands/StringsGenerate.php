<?php

namespace App\Console\Commands;

use App\Enums\Locale;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class StringsGenerate extends Command
{
    /**
     * @var Collection
     */
    protected $translations;

    protected $signature = 'strings:generate';

    protected $description = 'Generates JSON translation files from all packages';

    public function handle()
    {
        collect(Locale::codes())->each(function ($language) {
            $this->translations = collect();
            $path = resource_path("lang/vendor/nova/{$language}.json");

            $this->mergeJsonTranslations($language)
                ->mergeArrayTranslations($language)
                ->mergePackageTranslations($language)
                ->info("{$path} was generated");

            file_put_contents($path, $this->translations->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        });

        return true;
    }

    private function mergeJsonTranslations($language)
    {
        $translationFile = resource_path('lang/vendor/nova/base/' . $language . '.json');
        $translations = is_readable($translationFile) ? json_decode(file_get_contents($translationFile), true) : [];

        $this->translations = $this->translations->merge($translations);

        return $this;
    }

    private function mergeArrayTranslations($language, $path = null)
    {
        $path = $path ?? resource_path("lang/{$language}");

        if (!File::exists($path)) return null;

        collect(File::files($path))->each(function ($file) {
            $this->translations = $this->translations->merge(include $file);
        });

        return $this;
    }

    private function mergePackageTranslations($language)
    {
        collect($this->getPackages())->each(function ($path) use ($language) {
            $this->mergeArrayTranslations($language, "{$path}/resources/lang/{$language}");
        });

        return $this;
    }

    private function getPackages()
    {
        return glob(realpath(base_path('nova-components')) . '/*', GLOB_ONLYDIR);
    }
}
