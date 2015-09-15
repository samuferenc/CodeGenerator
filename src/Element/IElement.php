<?php

namespace samuferenc\CodeGenerator\Element;

/**
 *
 * @author samuf
 */
interface IElement
{
  public function getType();

  public function getName();

  public function getAttribute($name);
  
  public function getAttributes();  

  public function getChildElements();

  public function getParent();

  public function setType($type);

  public function setName($name);

  public function hasChild();

  /**
   *
   * @param string $key
   * @param string $value
   * @return IElement
   */
  public function addAttribute($key, $value);

  /**
   *
   * @param IElement $child
   * @return IElement
   */
  public function addChildElement(IElement $child);

  public function includeChildElements(IElement $parent);

  public static function Factory($type, $name);
}
