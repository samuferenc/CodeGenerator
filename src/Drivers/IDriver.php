<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator\Drivers;

/**
 *
 * @author virtual
 */
interface IDriver {
  public function includeGenerator($generator);
  
  public function setBaseDirectory($directory);
  
  public function CollectData();
  
  public function GenerateCode();

}
