<?php

namespace CliGenerator\Tests;

use CliGenerator\CliDiscovery;
use CliGenerator\CliManager;
use CliGenerator\Tests\Fixtures\TestCliResourceBuilder;

/**
 * Testing class.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliManagerTest extends \PHPUnit_Framework_TestCase
{

    protected static $fixturesPath;
    protected static $cliManager;
    protected static $cliResourceBuilder;
    protected static $cliDiscovery;

    public static function setUpBeforeClass()
    {
        self::$cliResourceBuilder = new TestCliResourceBuilder();
        self::$cliDiscovery = new CliDiscovery(self::$cliResourceBuilder);
        self::$cliManager = new CliManager(self::$cliDiscovery, '\CliGenerator\Tests\Fixtures\Test1Cli');
    }

    public function testGenerateCli()
    {
        $commands = $this::$cliManager->generateCli();
        $this->assertCount(3, $commands);
        $this->assertContainsOnly('\CliGenerator\Tests\Fixtures\Test1Cli', $commands);
    }
}
