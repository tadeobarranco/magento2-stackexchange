<?php declare(strict_types=1);

namespace Barranco\StackExchange\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;

class DevStackExchangeRunCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('dev:stackexchange:run')
            ->setDescription('Runs to evidence answers for the StackExchange questions');
        
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Success</info>');

        return Cli::RETURN_SUCCESS;
    }
}
