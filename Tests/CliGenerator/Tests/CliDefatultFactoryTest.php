<?php

namespace CliGenerator\Tests;

use CliGenerator\CliDefaultFactory;

/**
 * Testing class.
 *
 * @author Alberto Garcia Lamela <alberto.garcial@hotmail.com>
 *
 * @api
 */
class CliDefatultFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateCliWithDefaultClass()
    {
        $definition = array(
            'name' => 'name',
            'description' => 'description',
            'parameters' => array(
                'param1' => array(
                    'description' => 'description param1',
                ),
            ),
        );

        $cliDefaultFactory = new CliDefaultFactory();
        $this->assertInstanceOf('Symfony\Component\Console\Command\Command', $cliDefaultFactory->createCommand($definition));
    }

    public function testCreateCliWithSpecificClass()
    {

        $definition = array(
            'name' => 'name',
            'description' => 'description',
            'parameters' => array(
                'param1' => array(
                    'description' => 'description param1',
                ),
            ),
        );

        $cliDefaultFactory = new CliDefaultFactory('CliGenerator\Tests\Fixtures\Test1Cli');
        $this->assertInstanceOf('CliGenerator\Tests\Fixtures\Test1Cli', $cliDefaultFactory->createCommand($definition));
    }
}
