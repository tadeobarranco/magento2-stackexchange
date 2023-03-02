<?php declare(strict_types=1);

namespace Barranco\StackExchange\Console\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;

class DevStackExchangeLogCommand extends Command
{
    public const ARGUMENT_LOG_LEVEL = 'level';

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
                $this->logger->debug(var_export([$output, $logLevel], true));
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'info':
                $this->logger->info(sprintf('Successfully %s data logged', $logLevel));
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'notice':
                $this->logger->notice('Notice data logged');
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'warning':
                $this->logger->warning('Warning data logged');
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'error':
                $this->logger->error(
                    sprintf(
                        'Log level \'%s\' has an error. At %s in the %s function',
                        $logLevel,
                        __CLASS__,
                        __FUNCTION__
                    )
                );
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'critical':
                $this->logger->critical('Critical data logged');
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'alert':
                $this->logger->alert('Alert data logged');
                $this->writeSwitchCaseOutput($output, $logLevel);
                break;

            case 'emergency':
                $this->logger->emergency('Emergency data logged');
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
