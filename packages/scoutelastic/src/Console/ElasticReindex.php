<?php

namespace Nulisec\ScoutElastic\Console;

use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use Elasticsearch\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ElasticReindex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindexes All Searchables to ElasticSearch';

    /**
     * @var Client
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->reindex(Product::class);
        $this->reindex(User::class);
        $this->reindex(Team::class);

        return true;
    }

    private function reindex($model)
    {
        $index = config('scout.prefix') . str_replace('\\', '', Str::snake(Str::plural(class_basename($model))));

        if ($this->client->indices()->exists(['index' => $index])) {
            $this->client->indices()->delete(['index' => $index]);
        }

        $this->client->indices()->create([
            'index' => $index,
            'body'  => [
                'analysis' => [
                    'analyzer' => [
                        'default' => [
                            'tokenizer' => 'standard',
                            'filter' => ['standard', 'asciifolding', 'lowercase']
                        ]
                    ]
                ]
            ]
        ]);

        $this->call('scout:import', ['model' => $model]);
    }
}
