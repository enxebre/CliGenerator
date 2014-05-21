<?php

use CliGenerator\CliManager;
use CliGenerator\CliDiscovery;
use CliGenerator\Tests\Fixtures\CalculatorResourceBuilder;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Testing class for testing calculator cli.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliCalculatorTest extends \PHPUnit_Framework_TestCase
{

    protected static $fixturesPath;
    protected static $cliManager;
    protected static $cliResourceBuilder;
    protected static $cliDiscovery;

    public static function setUpBeforeClass()
    {
        self::$cliResourceBuilder = new CliGenerator\Tests\Fixtures\CalculatorResourceBuilder();
        self::$cliDiscovery = new CliDiscovery(self::$cliResourceBuilder);
        self::$cliManager = new CliManager(self::$cliDiscovery,'\CliGenerator\Tests\Fixtures\CalculatorCli');
    }

    public function testCliGeneratorLibrary()
    {

        $application = new Application();
        $application->addCommands($this::$cliManager->generateCli());

        $fixtures_commands = array(
            'calculator:max' => array(
                'params' => array(
                    'value1' => 10,
                    'value2' => 6,
                ),
                'expected' => 10,
            ),
            'calculator:min' => array(
                'params' => array(
                    'value1' => 10,
                    'value2' => 6,
                ),
                'expected' => 6,
            ),
            'calculator:abs' => array(
                'params' => array(
                    'value1' => -110,
                ),
                'expected' => 110,
            ),
            'calculator:sin' => array(
                'params' => array(
                    'value1' => M_PI_2,
                ),
                'expected' => 1,
            ),
        );

        foreach($fixtures_commands as $command => $definition) {
            $command = $application->find($command);
            $commandTester = new CommandTester($command);

            $definition['params']['command'] = $command->getName();
            $commandTester->execute($definition['params']);

            $this->assertTrue($definition['expected'] == $commandTester->getDisplay());
        }
    }
}