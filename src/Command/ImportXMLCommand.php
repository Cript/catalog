<?php

namespace App\Command;

use App\Context\ImportXML\Application\Command\ImportXML\ImportXML;
use App\Context\Shared\Application\Bus\Command\CommandBusInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(name: 'import:xml')]
class ImportXMLCommand extends Command
{
    public function __construct(
        private Filesystem $filesystem,
        private CommandBusInterface $commandBus
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'XML file name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = realpath($input->getArgument('file'));

        if(!$this->filesystem->exists($file)) {
            return Command::FAILURE;
        }

        $command = new ImportXML($file);
        try {
            $this->commandBus->dispatch($command);
        } catch (\Exception $e) {
            $output->writeln('<error>Error occurred when import xml</error>');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
