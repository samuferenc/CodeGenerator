<?php

namespace samuferenc\CodeGenerator;

use samuferenc\CodeGenerator\PHPParser;
use samuferenc\CodeGenerator\Log;
use samuferenc\CodeGenerator\Element\Element;
use samuferenc\CodeGenerator\Element\Type;

/**
 * Description of ClassInfo
 *
 * @author virtual
 */
class ClassInfo extends Element
{
  const FQSEN = '__FQSEN__';
  const NS = '__NAMESPACE__';
  const FILENAME = '__FILENAME__';
  
  public function getFilename()
  {
    return $this->getAttribute(self::FILENAME);
  }
  
  public function setFilename($value)
  {
    $this->addAttribute(self::FILENAME, $value);
    return $this;    
  }
  
  public function getClassname()
  {
    return $this->name;
  }
  
  public function setClassname($value)
  {
    $this->name = $value;
    return $this;    
  }

  public function getFQSEN()
  {
    return $this->getAttribute(self::FQSEN);
  }
  
  public function setFQSEN($value)
  {
    $this->addAttribute(self::FQSEN, $value);
    return $this;
  }
  
  public function getNamespace()
  {
    return $this->getAttribute(self::NS);    
  }
  
  public function setNamespace($value)
  {
    $this->addAttribute(self::NS, rtrim($value, "\\"));    
    return $this;    
  }
  
  public function __construct($filename, $classname, $namespace = "\\")
  {
    $this
            ->setFilename($filename)
            ->setClassname($classname)
            ->setNamespace($namespace)
            ->setFQSEN(sprintf('%s\%s', $this->getNamespace(), $this->getClassname()))
            ->setType(Type::ClassElement);
  }

  public static function FactoryByFilename($filename)
  {
    $parser = new PHPParser($filename);

    if (count($parser->classes) == 0) return null;
    
    return new ClassInfo($filename, $parser->classes[0], $parser->namespace);    
  }
}

?>