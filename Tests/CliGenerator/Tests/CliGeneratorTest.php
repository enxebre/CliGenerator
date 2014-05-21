<?php

use CliGenerator\CliManager;
use CliGenerator\CliDiscovery;
use CliGenerator\Tests\Fixtures\TestCliResourceBuilder;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Testing class for testing the integration between all library components.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliGeneratorTest extends \PHPUnit_Framework_TestCase
{

    protected static $fixturesPath;
    protected static $cliManager;
    protected static $cliResourceBuilder;
    protected static $cliDiscovery;

    public static function setUpBeforeClass()
    {
        self::$cliResourceBuilder = new TestCliResourceBuilder();
        self::$cliDiscovery = new CliDiscovery(self::$cliResourceBuilder);
        self::$cliManager = new CliManager(self::$cliDiscovery,'\CliGenerator\Tests\Fixtures\Test1Cli');
    }

    public function testCliGeneratorLibrary()
    {

        $application = new Application();
        $application->addCommands($this::$cliManager->generateCli());

        $fixtures_commands = $this::$cliResourceBuilder->buildDefinitions();

        foreach ($fixtures_commands as $command => $definition) {
            $command = $application->find($definition['name']);
            $commandTester = new CommandTester($command);
            $commandTester->execute(
                array('command' => $command->getName(), 'param1' => 'Value for param1')
            );

            $this->assertRegExp("/Value for param1/", $commandTester->getDisplay());
        }
    }
}
