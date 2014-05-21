<?php

namespace CliGenerator;

/**
 * Interface used by the Discovery class for creating commands.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
Interface CliFactoryInterface
{

    /**
     * Creates a command given an array definition.
     *
     * @param $commandDefinition Array
     * @return Instance of a class extending Command Class.
     *
     * @api
     */
    public function createCommand(array $commandDefinition);

}
