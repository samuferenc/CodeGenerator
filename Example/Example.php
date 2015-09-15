<?php

namespace Example;

/**
 * Description of Example
 *
 * @dumpinfo ExampleClass
 * @author virtual
 */
class ExampleClass
{
  /**
   * @Column(type="integer")
   * @var integer 
   */
  public $id;  
  /**
   * @Column(type="string", length=32, unique=true, nullable=false)
   * @var string 
   */
  public $value;
  
  /** @dumpinfo doNothing dump */
  public function doNothing()
  {    
  
  }  
}
