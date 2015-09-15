<?php

namespace samuferenc\CodeGenerator;

use samuferenc\CodeGenerator\Drivers\IDriver;
use samuferenc\CodeGenerator\Element\Element;
use samuferenc\CodeGenerator\Element\Type;
use samuferenc\CodeGenerator\Log;
use phpDocumentor\Reflection\DocBlock;

class CodeGenerator
{
  /**
   *
   * @var ClassInfo[] 
   */
  private $classes = array();
  private $drivers = array();
  private $registratedParams = array();

  public function __construct()
  {
    
  }
  
  public static function Factory()
  {
    return new self();
  }
  
  public function getClasses()
  {
    return $this->classes;  
  }

  /**
   * 
   * @param string $filename
   * @return \samuferenc\CodeGenerator\CodeGenerator
   */
  public function AddClassFile($filename)
  {
    if (empty($filename))
      return $this;

    Log::Info('Load file: %s', $filename);
    $this->AddClassInfo(ClassInfo::FactoryByFilename($filename));
    return $this;
  }

  /**
   * 
   * @param \samuferenc\CodeGenerator\ClassInfo $classInfo
   * @return \samuferenc\CodeGenerator\CodeGenerator
   */
  public function AddClassInfo($classInfo)
  {
    if ($classInfo == null) 
      return;
    
    if (isset($this->classes[$classInfo->getFQSEN()]))
    {
      Log::Warning('Already exists class: %s', $classInfo->getFQSEN());
    }

    $this->classes[$classInfo->getFQSEN()] = $classInfo;
    return $this;
  }

  public function AddDirectory($path, $recursive = true)
  {
    $this->discoverDirectory($path, $recursive);
    return $this;
  }

  private function discoverDirectory($path, $recursive = true)
  {
    if (false)
    {
      Log::Warning('Not valid directory: %s', $path);
      return;
    }

    $rdi = new \RecursiveDirectoryIterator(realpath($path));

    $iterator = new \RecursiveIteratorIterator($rdi);
    $iterator->setMaxDepth($recursive ? -1 : 0);

    foreach ($iterator as $file)
    {
      if ($file->isFile() && $file->getExtension() == 'php')
      {
        $this->AddClassFile($file->getRealPath());
      }
    }
  }
  
  public function AddDriver(IDriver $driver)
  {    
    $driver->includeGenerator($this);
    $this->drivers[] = $driver;
    return $this;
  }
  
  public function RegistrationParam($param)
  {
    $this->registratedParams[] = $param;
    return $this;
  }
  
  public function GenAllOutput()
  {
    foreach($this->drivers as $driver)
    {     
      $driver->GenOutput();
    }    

    return $this;
  }

  private function collectTags($docBlock, $element)
  {
    foreach($docBlock->getTags() as $tag)
    {
      if (in_array($tag->getName(), $this->registratedParams))
      {
        $element->addAttribute($tag->getName(), $tag->getDescription());
      }
    }        
  }
  
  /**
   * 
   * @return \samuferenc\CodeGenerator\CodeGenerator
   */
  public function CollectElements()
  {
    foreach($this->classes as $class)
    {
      require $class->getFilename();
      $refClass = new \ReflectionClass($class->getFQSEN());
      
      $this->collectTags(new DocBlock($refClass->getDocComment()), $class);      
      
      // Collect properties
      foreach($refClass->getProperties(\ReflectionProperty::IS_PUBLIC) as $property)
      {
        $element = Element::Factory(Type::PropertyElement, $property->getName());
        
        $this->collectTags(new DocBlock($property->getDocComment()), $element);      
       
        $class->addChildElement($element);
      }   
      
      // Collect methods
      foreach($refClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method)
      {
        $element = Element::Factory(Type::MethodElement, $method->getShortName());
        
        $this->collectTags(new DocBlock($method->getDocComment()), $element);              
        
        $class->addChildElement($element);
      }   
    }
    return $this;
  }
  
}

?>