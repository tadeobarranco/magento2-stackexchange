<?php declare(strict_types=1);

namespace Barranco\StackExchange\Console\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;

class DevStackExchangeRunCommand extends Command
{
    private LoggerInterface $logger;

    /**
     * Class constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        parent::__construct();
        $this->logger = $logger;
    }

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
        if ($this->logger instanceof LoggerInterface) {
            $output->writeln('<info>Successfully created a new object using DI</info>');
            $this->logger->info('Successfully created a new object using DI');
        }

        return Cli::RETURN_SUCCESS;
    }
}
