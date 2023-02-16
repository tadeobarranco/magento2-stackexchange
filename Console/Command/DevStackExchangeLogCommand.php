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

        switch ($logLevel) {
            case 'debug':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'info':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'notice':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'warning':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'error':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'critical':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'alert':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'emergency':
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            default:
                $this->writeSwitchCaseOutput($output);
                break;
        }


        return Cli::RETURN_SUCCESS;
    }

    /**
     * Write Output Switch Case Based
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param string $logLevel
     * @return bool
     */
    protected function writeSwitchCaseOutput(OutputInterface $output, $logLevel = '')
    {
        if ($logLevel !== '') {
            $output->writeln('<info>Successfully ' . $logLevel . ' data logged</info>');
        } else {
            $output->writeln('<info>Non-existen log level');
        }

        return true;
    }
}
