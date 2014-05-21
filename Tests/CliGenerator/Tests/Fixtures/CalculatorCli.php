<?php

namespace CliGenerator\Tests\Fixtures;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Fixture class for creating calculator commands.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CalculatorCli extends \CliGenerator\CliBase
{

    private $operator = '';

    /**
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    protected function configure()
    {

        $definition = $this->getCommandDefinition();
        $this
            ->setDescription($definition['description'])
        ;

        $this->setOperator($definition['operator']);

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

        $operator = $this->getOperator();

        if ($input->hasArgument('value2')) {
            $result = $operator($input->getArgument('value1'), $input->getArgument('value2'));
        }
        else {
            $result = $operator($input->getArgument('value1'));
        }

        $output->write($result);

    }
}
