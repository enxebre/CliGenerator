<?php

namespace CliGenerator;

/**
 * Implementation of CliDiscoveryInterface. Relies on CliResourceBuilderInterface
 * and CliFactoryInterface for discovering and returning a load of commands
 * from a given resource.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliDiscovery implements CliDiscoveryInterface
{
    private $cliResourceBuilder;
    private $cliFactory;
    private $cliDefinitions;

    /**
     * Constructor.
     *
     * @param CliResourceBuilderInterface $CliResourceBuilder
     * @param CliFactoryInterface $CliFactory
     */
    public function __construct(CliResourceBuilderInterface $cliResourceBuilder, CliFactoryInterface $cliFactory = null)
    {
        $cliFactory == null ? new CliDefaultFactory() : $cliFactory;
        $this->resourceBuilder = $cliResourceBuilder;
        $this->cliFactory = $cliFactory;
        $this->cliResourceBuilder = $cliResourceBuilder;
        $this->cliDefinitions = $this->buildDefinitions();

    }

    /**
     * {@inheritdoc}
     */
    public function setCliFactory(CliFactoryInterface $cliFactory)
    {
        $this->cliFactory = $cliFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function buildDefinitions()
    {

        $cliDefinitions = $this->cliResourceBuilder->buildDefinitions();
        return $cliDefinitions;
    }

    /**
     * {@inheritdoc}
     */
    public function generateCommands()
    {

        foreach($this->cliDefinitions as $key => $singleCommandDefinition) {
            $commands[] = $this->generateCommand($singleCommandDefinition);
        }

        return $commands;
    }

    /**
     * {@inheritdoc}
     */
    public function generateCommand($singleCommandDefinition)
    {
        return $this->cliFactory->createCommand($singleCommandDefinition);
    }
}
