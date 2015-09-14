<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator\Drivers\SQL;

use samuferenc\CodeGenerator\Drivers\BaseDriver;

/**
 * Description of Driver
 *
 * @author virtual
 */
class Driver extends BaseDriver
{
  const Column = "column";

  public function includeGenerator($codeGenerator)
  {
    parent::includeGenerator($codeGenerator);
    $this->codeGenerator->RegistrationParam(self::Column);
  }

  public function CollectData()
  {
    
  }

  public function GenerateCode()
  {
    
  }

}
