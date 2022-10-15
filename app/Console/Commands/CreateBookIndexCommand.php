<?php

namespace App\Console\Commands;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class CreateBookIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:create-book-index';

    private $client;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial command for index old data of Book';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ClientBuilder $builder)
    {
        parent::__construct();

        $this->client = $builder::fromConfig(
            Config::get('elasticsearch')
        );
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $params = [
            'index' => 'books',
            'body'  => [
                'mappings' => [
                    'properties' => [
                        'id'     => [
                            'type' => 'long',
                        ],
                        'title'  => [
                            'type' => 'text',
                        ],
                        'author' => [
                            'type' => 'text',
                        ],
                        'genre'  => [
                            'type' => 'text',
                        ],
                        'description'  => [
                            'type' => 'text',
                        ],
                        'isbn'  => [
                            'type' => 'long',
                        ],
                        'published'  => [
                            'type' => 'date',
                        ],
                        'publisher'  => [
                            'type' => 'text',
                        ]
                    ],
                ],
            ],
        ];

        $this->client->indices()->create($params);
    }
}
