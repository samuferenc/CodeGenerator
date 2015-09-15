<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator\Drivers;

use samuferenc\CodeGenerator\CodeGenerator;

/**
 *
 * @author virtual
 */
interface IDriver
{
  public function includeGenerator(CodeGenerator $generator);

  public function GenOutput();
}
