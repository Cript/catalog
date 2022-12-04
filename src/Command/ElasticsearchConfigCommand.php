<?php

namespace App\Command;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'elasticsearch:config')]
class ElasticsearchConfigCommand extends Command
{
    private Client $client;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->client = ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();

        $this->createProductIndex();

        return Command::SUCCESS;
    }

    private function createProductIndex() {
        $params = [
            'index' => 'product',
            'body' => [
                'index' => [
                    "max_result_window" => 10000000
                ],
                'mappings' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'name' => [
                            'type' => 'text'
                        ],
                        'weight' => [
                            'type' => 'integer'
                        ],
                        'category_id' => [
                            'type' => 'keyword'
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->client->indices()->create($params);

        dd($response->asArray());  // response body content as array
    }
}
