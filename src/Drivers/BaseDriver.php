<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator\Drivers;

use samuferenc\CodeGenerator\Drivers\IDriver;

/**
 * Description of driver
 *
 * @author virtual
 */
class BaseDriver implements IDriver
{
  protected $codeGenerator;
  
  public function includeGenerator($codeGenerator)
  {
    $this->codeGenerator = $codeGenerator;
  }  
  
  protected $baseDirectory;

  public function setBaseDirectory($directory)
  {
    $this->baseDirectory = $directory;
    return $this;
  }
  
  public function Factory()
  {
    $classname = get_called_class();
    return new $classname();    
  }

}
