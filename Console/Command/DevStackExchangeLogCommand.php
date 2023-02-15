<?php declare(strict_types=1);

namespace Barranco\StackExchange\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;

class DevStackExchangeLogCommand extends Command
{
    public const ARGUMENT_LOG_LEVEL = 'level';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('dev:stackexchange:log');
        $this->setDescription('Displays data using different log levels');
        $this->addArgument(
            self::ARGUMENT_LOG_LEVEL,
            InputArgument::REQUIRED,
            'The log level to store data.'
        );
        $this->setHelp(
            <<<HELP
            To start logging data:

            <comment>%command.full_name% someLevel</comment>
            HELP
        );
        
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logLevel = $input->getArgument(self::ARGUMENT_LOG_LEVEL);
        $output->writeln('<info>Successfully ' . $logLevel . ' data logged</info>');

        return Cli::RETURN_SUCCESS;
    }
}
