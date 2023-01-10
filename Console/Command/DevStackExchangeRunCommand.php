<?php declare(strict_types=1);

namespace Barranco\StackExchange\Console\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ObjectManager;
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
        $logger = ObjectManager::getInstance()->get(LoggerInterface::class);

        if ($logger instanceof LoggerInterface) {
            $output->writeln('<info>Successfully created a new object using ObjectManager</info>');
            $logger->info('Successfully created a new object using ObjectManager');
        }

        return Cli::RETURN_SUCCESS;
    }
}
