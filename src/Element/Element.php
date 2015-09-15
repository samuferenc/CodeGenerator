<?php

namespace samuferenc\CodeGenerator\Element;

use samuferenc\CodeGenerator\Element\IElement;

/**
 * Description of Element
 *
 * @author virtual
 */
class Element implements IElement
{
  protected $parent = null;

  protected $type;

  protected $name;

  protected $attributes = array();

  protected $childElements = array();

  public function getType()
  {
    return $this->type;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getAttributes()
  {
    return $this->attributes;
  }

  /**
   * @return arrayOfIElement
   */  
  public function getChildElements()
  {
    return $this->childElements;
  }

  public function hasChild()
  {
    return count($this->childElements) > 0;
  }

  /**
   *
   * @param string $type
   * @param string $name
   * @return IElement
   */
  public static function Factory($type, $name)
  {
    $element = new self();
    return $element->setType($type)->setName($name);
  }

  public function addAttribute($key, $value)
  {
    $this->attributes[$key] = $value;
  }

  /**
   *
   * @param IElement $child
   */
  public function addChildElement(IElement $child)
  {
    $this->childElements[] = $child;
    $child->includeChildElements($this);
    return $this;
  }

  public function getParent()
  {
    return $this->parent;
  }

  public function includeChildElements(IElement $parent)
  {
    $this->parent = $parent;
  }

  public function setName($name)
  {
    $this->name = $name;
    return $this;
  }

  public function setType($type)
  {
    $this->type = $type;
    return $this;
  }

  public function getAttribute($name)
  {
    return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
  }
  
}
