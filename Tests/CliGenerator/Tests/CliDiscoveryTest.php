<?php

namespace CliGenerator\Tests;

use CliGenerator\CliDefaultFactory;
use CliGenerator\CliDiscovery;
use CliGenerator\Tests\Fixtures\TestCliResourceBuilder;

/**
 * Testing class.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliDiscoveryTest extends \PHPUnit_Framework_TestCase
{

    protected static $fixturesPath;
    protected static $cliFactory;
    protected static $cliResourceBuilder;
    protected static $cliDiscovery;

    public static function setUpBeforeClass()
    {
        self::$cliFactory = new CliDefaultFactory('CliGenerator\Tests\Fixtures\Test1Cli');
        self::$cliResourceBuilder = new TestCliResourceBuilder();
        self::$cliDiscovery = new CliDiscovery(self::$cliResourceBuilder, self::$cliFactory);

    }

    public function testBuildDefinitions()
    {
        $definitions = $this::$cliDiscovery->buildDefinitions();
        $this->assertArrayHasKey('command1', $definitions);
        $this->assertArrayHasKey('name', $definitions['command1']);
        $this->assertArrayHasKey('command2', $definitions);
        $this->assertArrayHasKey('name', $definitions['command1']);
        $this->assertArrayHasKey('command3', $definitions);
        $this->assertArrayHasKey('name', $definitions['command3']);
    }

    public function testGenerateCommand()
    {
        $definitions = $this::$cliDiscovery->buildDefinitions();
        $command = $this::$cliDiscovery->generateCommand($definitions['command1']);
        $this->assertInstanceOf('\CliGenerator\Tests\Fixtures\Test1Cli', $command);
    }

    public function testGenerateCommands()
    {
        $definitions = $this::$cliDiscovery->buildDefinitions();
        $commands = $this::$cliDiscovery->generateCommands($definitions);
        $this->assertCount(3, $commands);
        $this->assertContainsOnly('CliGenerator\Tests\Fixtures\Test1Cli', $commands);
        $this->assertContainsOnly('CliGenerator\Tests\Fixtures\Test1Cli', $commands);
    }
}
