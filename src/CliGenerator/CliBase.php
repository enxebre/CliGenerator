<?php

namespace CliGenerator;

use Symfony\Component\Console\Command\Command;
/**
 * Command Class which expects a an array definition that can be used by
 * the configure() function for adding parameter dynamically.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliBase extends Command
{
    private $commandDefinition;

    public function __construct($definition)
    {

        if (!isset($definition['name']) || empty($definition['name'])) {
            throw new \LogicException('The command name cannot be empty.');
        }

        $this->setCommandDefinition($definition);
        parent::__construct($definition['name']);
    }

    public function getCommandDefinition()
    {
        return $this->commandDefinition;
    }

    public function setCommandDefinition($commandDefinition)
    {
        $this->commandDefinition = $commandDefinition;
    }
}
