<?php

namespace CliGenerator\Tests\Fixtures;

use CliGenerator\CliResourceBuilderInterface;
/**
 * Class responsible for building an array of definitions
 * from a given source (e.g. json file) ready to be used
 * for a Custom Cli class in order to create custom commands
 * dynamically.
 *
 * @author Alberto Garcia <alberto.garcial@hotmail.com>
 *
 * @api
 */
Class CalculatorResourceBuilder implements CliResourceBuilderInterface
{

    private $source;

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }
    /**
     * Constructor.
     *
     * @param null $source The source where live our Cli definitions.
     */
    public function __construct($source = '/CalculatorDefinition.json') {
        $this->setSource(dirname(__FILE__) . $source);
    }

    /**
     * Responsible for parser a given source and turning
     * it into an array usable by a custom comand class.
     *
     * @return array of the definitions
     *
     * @api
     */
    public function buildDefinitions() {

        $jsonDefinition = file_get_contents($this->getSource());
        $arrayDefinition = json_decode($jsonDefinition, TRUE);
        return $arrayDefinition;
    }

}