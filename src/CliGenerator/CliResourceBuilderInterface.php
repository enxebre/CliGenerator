<?php

namespace CliGenerator;

/**
 * Class responsible for building an array of definitions
 * from a given source (e.g. json file) ready to be used
 * for a Custom Command class in order to create custom commands
 * dynamically.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
Interface CliResourceBuilderInterface
{

    /**
     * Constructor.
     *
     * @param null $source The source where live our command definitions.
     */
    public function __construct($source = null);

    /**
     * Responsible for parser a given source and turning
     * it into an array usable by a custom comand class.
     *
     * @return array of the definitions
     *
     * @api
     */
    public function buildDefinitions();

}