<?php

namespace Example\Level2;

/**
 * Description of ExampleLevel
 *
 * @author virtual
 */
class ExampleLevel
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
  public $name;
}