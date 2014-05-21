<?php

namespace CliGenerator;

/**
 * Default Implementation of CliFactoryInterface used by
 * the Discovery class for creating commands.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliDefaultFactory implements CliFactoryInterface
{
    private $customClass;

    /**
     * Constructor.
     *
     * @param string $customClass A string with name of the class
     * we want to create.
     */
    public function __construct($customClass = null)
    {
        $this->customClass = $customClass ? $customClass : null;
    }

    /**
     * @param array $commandDefinition
     * @return Instance of $customClass or '\Symfony\Component\Console\Command\command'.
     *
     * @api
     */
    public function createCommand(array $commandDefinition = array())
    {

        $class = $this->customClass ? $this->customClass : '\CliGenerator\CliBase';

        return new $class($commandDefinition);
    }
}
