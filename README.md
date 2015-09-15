# CodeGenerator

Installation
------------
composer.json
```
{
  "require": {
    "samuferenc/codegenerator": "dev-master"
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
