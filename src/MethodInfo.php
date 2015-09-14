<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator;

/**
 * Description of RemotelyAccessableMethod
 *
 * @author virtual
 */
class MethodInfo
{

  public $classInfo;
  public $name;

  /**
   *
   * @var string 
   */
  public $description;

  /**
   *
   * @var array VarInfo[] 
   */
  public $params;

  /**
   *
   * @var VarInfo 
   */
  public $return;

}
