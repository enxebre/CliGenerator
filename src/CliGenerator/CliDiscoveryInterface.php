<?php

namespace CliGenerator;

/**
 * Discovery Interface use by the manager for generates commands
 * from a given resource.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
Interface CliDiscoveryInterface
{
    /**
     * Set the CliFactory used for generating the command instances.
     *
     * @param CliFactoryInterface $cliFactory
     */
    public function setCliFactory(CliFactoryInterface $cliFactory);

    /**
     * Use CliResourceBuilderInterface for returning an array
     * given a source of definitions.
     *
     * @return array of definitions for building commands from.
     *
     * @api
     */
    public function buildDefinitions();

    /**
     * Generates a load of commands
     *
     * @return array of instances extending Command Class.
     *
     * @api
     */
    public function generateCommands();

    /**
     * Generates a single command.
     *
     * @param $singleCommandDefinition An array used by a custom Command class for creating a command.
     * @return instance extending Command Class.
     *
     * @api
     */
    public function generateCommand($singleCommandDefinition);

}
