CliGenerator is a tool for creating cli from configuration files (.json, .yaml, etc.) extending [Console Symfony Component](https://github.com/symfony/Console)
============================================================================================
[![Build Status](https://travis-ci.org/enxebre/CliGenerator.png?branch=master)](https://travis-ci.org/enxebre/CliGenerator)
 
CliGenerator (command-line interface generator) is a library that complements the Symfony Console Component
providing a tool for generating loads of commands dynamically from a given
source (.json file, method returning an array, .yaml file, etc.).

This library is on [packagist](https://packagist.org/packages/enxebre/cli-generator)

### Installing via Composer

The recommended way to install CliGenerator is through [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Adding CliGenerator:
Add to your current composer.json ```require``` key: ```"enxebre/cli-generator":"1.0.*" ```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

##Usage##

```php
$cliManager = new cliManager(new cliDiscovery(new cliYourResourceBuilder($your_source_file)), $YourcliClassName);

$application = new Application();
$application->addCommands($cliManager->generateCli());
$application->run();
```

All you need to do is to create a "CliManager" Class and pass the generated commands
to your console application like in the example above.

You should implement the "CliResourceBuilderInterface" interface for returning
the definitions that will be used for your "CustomCli" Class for
building the load of commands.

##Example##

Some use cases would be a REST API Cli ( you could use [Guzzle](https://github.com/guzzle/guzzle)) or a Database Cli among others.

Dynamic Calculator Cli:
The next one is an example tested in the library suite tests. See CliCalculatorTest.php

Definition:

```json
{
    "absolute":
    {
        "name":"calculator:abs",
        "description":"Absolute value.",
        "operator":"abs",
        "parameters":
        {
            "value1":{
                "description":"first value"
            }
        }
    },
    "maximum":
    {
        "name":"calculator:max",
        "description":"Maximum of params.",
        "operator":"max",
        "parameters":
        {
            "value1":
            {
                "description":"first value"
            },
            "value2":
            {
                "description":"second value"
            }
        }
    },
    "minimum":
    {
        "name":"calculator:min",
        "description":"Minimum of params.",
        "operator":"min",
        "parameters":
        {
            "value1":
            {
                "description":"first value"
            },
            "value2":
            {
                "description":"second value"
            }
        }
    },
    "Cosine":
    {
        "name":"calculator:cos",
        "description":"Cosine calculator.",
        "operator":"cos",
        "parameters":
        {
            "value1":
            {
                "description":"first value"
            }
        }
    },
    "Sin":
    {
        "name":"calculator:sin",
        "description":"Sine of params.",
        "operator":"sin",
        "parameters":
        {
            "value1":
            {
                "description":"first value"
            }
        }
    },
    "Tan":
    {
        "name":"calculator:tan",
        "description":"Tangent calculator.",
        "operator":"tan",
        "parameters":
        {
            "value1":
            {
                "description":"first value"
            }
        }
    }
}
```

Resource builder:

```php
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
     * @param null $source The source where live our cli definitions.
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
```

Custom Cli class:

```php
class CalculatorCli extends \CliGenerator\CliBase
{

    private $operator = '';

    /**
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    protected function configure()
    {

        $definition = $this->getCommandDefinition();
        $this
            ->setDescription($definition['description'])
        ;

        $this->setOperator($definition['operator']);

        foreach($definition['parameters'] as $param => $details) {
            $this->addArgument(
                $param,
                null,
                "Introduce a ${details['description']}."
            );
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $operator = $this->getOperator();

        if ($input->hasArgument('value2')) {
            $result = $operator($input->getArgument('value1'), $input->getArgument('value2'));
        }
        else {
            $result = $operator($input->getArgument('value1'));
        }

        $output->write($result);

    }
}
```

You could now add as many commands as you want to your CLI just modifying the definition.json file.
