<?php

namespace App\Command;

use App\Context\Products\Application\Query\GetProducts\GetCategories;
use App\Context\Products\Application\Query\GetProducts\GetProductsHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'product:get')]
class GetProductsCommand extends Command
{
    public function __construct(
        private readonly GetProductsHandler $handler
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $command = new GetCategories(0, 10);
        try {
            $result = call_user_func($this->handler, $command);

            return Command::SUCCESS;
        } catch (\Exception $e) {

        }
    }
}
