<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator\Drivers;

use samuferenc\CodeGenerator\CodeGenerator;
use samuferenc\CodeGenerator\Drivers\IDriver;
use samuferenc\CodeGenerator\Log;

/**
 * Description of driver
 *
 * @author virtual
 */
abstract class BaseDriver implements IDriver
{

  /** @var array **/
  protected $config;
  
  /** @var CodeGenerator **/
  protected $codeGenerator;

  public function __construct($config)
  {
    $this->config = $config;
  }

  /**
   * 
   * @param array $config
   * @return IDriver
   */
  public static function Factory($config = null)
  {
    $classname = get_called_class();
    return new $classname($config);
  }

  public function includeGenerator(CodeGenerator $codeGenerator)
  {
    $this->codeGenerator = $codeGenerator;
  }

}
