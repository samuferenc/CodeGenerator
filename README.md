# CodeGenerator

Installation
------------
composer.json
```
{
  "require": {
    "samuferenc/codegenerator": "dev-master",
    "phpdocumentor/reflection-docblock": "2.0.4",
    "smarty/smarty": "~3.1"
  },
	"autoload": {
        "psr-4": {"samuferenc\\CodeGenerator\\": ["vendor/samuferenc/codegenerator/src/"]}
    }
}
```

Example: index.php
```
<?php

require 'vendor/autoload.php';

use samuferenc\CodeGenerator\CodeGenerator;
use samuferenc\CodeGenerator\Drivers\Dump\Driver as DumpDriver;
use samuferenc\CodeGenerator\Drivers\SQL\Driver as SQLDriver;

$cg = CodeGenerator::Factory()
        // ->AddDriver(DumpDriver::Factory(array('output' => 'dump')))        
        ->AddDriver(SQLDriver::Factory(array('output' => 'html')))                
        ->AddDirectory('vendor/samuferenc/codegenerator/Example')
        ->CollectElements()
        ->GenAllOutput();

?>
```
