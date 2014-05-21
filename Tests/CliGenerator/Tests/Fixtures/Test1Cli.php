<?php

namespace CliGenerator\Tests\Fixtures;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Fixture class for creating dumb commands.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class Test1Cli extends \CliGenerator\CliBase
{

    protected function configure()
    {

        $definition = $this->getCommandDefinition();
        $this
            ->setDescription($definition['description'])
        ;

        foreach($definition['parameters'] as $param => $details) {
            $this->addArgument(
                $param,
                null,
                "Introduce a ${details['description']}."
            );

        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arg = $input->getArgument('param1');
        $output->writeln(sprintf($arg));

    }
}
