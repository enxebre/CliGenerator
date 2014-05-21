<?php

namespace CliGenerator;

/**
 * Manager class for setting the classes responsible for discovering
 * and generating commands objects from a given source.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliManager {

    private $cliFactory;
    private $cliDiscovery;

    /**
     * Constructor.
     *
     * @param CliDiscoveryInterface $cliDiscovery
     * @param $factoryReturningCommandClass
     * @param CliFactoryInterface $cliFactory
     *
     * @api
     */
    public function __construct(CliDiscoveryInterface $cliDiscovery, $factoryReturningCommandClass = '', CliFactoryInterface $cliFactory = null)
    {
        $cliFactory = $cliFactory ? $cliFactory : new CliDefaultFactory($factoryReturningCommandClass);
        $this->cliFactory = $cliFactory;
        $this->cliDiscovery = $cliDiscovery;
        $this->setCliFactory();
    }


    /**
     * Set the factory class used by the discovery class
     * for creating new commands.
     *
     * @see generateCommand($singleCommandDefinition)
     */
    protected function setCliFactory()
    {
        $this->cliDiscovery->setCliFactory($this->cliFactory);
    }

    /**
     * @return array of instances extending Command Class.
     *
     * @api
     */
    public function generateCli()
    {
        return $this->cliDiscovery->generateCommands();
    }
}
