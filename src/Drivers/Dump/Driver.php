<?php

namespace samuferenc\CodeGenerator\Drivers\Dump;

use samuferenc\CodeGenerator\CodeGenerator;
use samuferenc\CodeGenerator\Element\IElement;
use samuferenc\CodeGenerator\Drivers\BaseDriver;

/**
 * Description of Dump Driver
 *
 * @author virtual
 */
class Driver extends BaseDriver
{
  const Dump = "dump";
  const DumpInfo = "dumpinfo";

  public function includeGenerator(CodeGenerator $codeGenerator)
  {
    parent::includeGenerator($codeGenerator);
    $this->codeGenerator
            ->RegistrationParam(self::Dump)
            ->RegistrationParam(self::DumpInfo);
  }

  public function GenOutput()
  {
    foreach($this->codeGenerator->getClasses() as $class)
    {
      $this->PrintDumpInfo($class);
    }
  }
  
  private function PrintDumpInfo(IElement $element)  
  {
    echo $element->getAttribute(self::DumpInfo) . "\n";
    if ($element->hasChild())
    {
      foreach ($element->getChildElements() as $child)
      {
        $this->PrintDumpInfo($child);        
      }
    }
  }

}