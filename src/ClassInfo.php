<?php

namespace samuferenc\CodeGenerator;

use samuferenc\CodeGenerator\PHPParser;
use samuferenc\CodeGenerator\Log;

/**
 * Description of ClassInfo
 *
 * @author virtual
 */
class ClassInfo
{
  private $filename;
  
  private $classname;

  /**
   * Fully Qualified Structural Element Name
   * 
   * @var string 
   */
  private $fqsen;
  
  private $namespace;
  
  private $params = array();
  
  public function getFilename()
  {
    return $this->filename;
  }
  
  public function getClassname()
  {
    return $this->classname;
  }

  public function getFQSEN()
  {
    return $this->fqsen;
  }
  
  public function getNamespace()
  {
    return $this->namespace;    
  }
  
  /**
   * Get driver specific value
   * 
   * @param string $name
   * @return null
   */
  public function getParam($name)
  {
    if(isset($this->params[$name]))
    {
      return $this->params[$name];
    }
    
    return null;
  }
  
  /**
   * Set driver specific value
   * 
   * @param type $name
   * @param type $value
   */
  public function setParam($name, $value)
  {
    $this->params[$name] = $value;
  }
  
  public function __construct($filename, $classname, $namespace = "\\")
  {
    $this->filename = $filename;
    $this->classname = $classname;
    $this->namespace = $namespace;
    $this->fqsen = sprintf('%s\%s', rtrim($classInfo->namespace, "\\"), $classInfo->classname);
  }

  public static function Factory($filename)
  {
    $parser = new PHPParser($filename);

    if (count($parser->classes) == 0) return null;
    
    return new ClassInfo($filename, $parser->classes[0], $parser->namespace);    
  }
}

?>