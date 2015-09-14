<?php

namespace samuferenc\CodeGenerator;

use samuferenc\CodeGenerator\Drivers\IDriver;
use samuferenc\CodeGenerator\Log;


// Fajlok keresese
// Template-ek
// Osszeallitas

class CodeGenerator
{
  private $classes = array();
  private $drivers = array();
  private $registratedParams = array();

  public function __construct()
  {
    
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

    Log::Info('Load class: %s', $filename);
    $this->AddClassInfo(ClassInfo::Factory($filename));
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
    
    if (isset($this->classes[$classInfo->fqsen]))
    {
      Log::Warning('Already exists class: %s', $classInfo->$fqsen);
    }

    $this->classes[$classInfo->fqsen] = $classInfo;
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

    $rdi = new RecursiveDirectoryIterator(realpath($path));

    $iterator = new RecursiveIteratorIterator($rdi);
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
    $this->drivers[] = $driver->includeGenerator($this);
    return $this;
  }
  
  public function RegistrationParam($param)
  {
    $this->registratedParams[] = $param;
    return $this;
  }
}

?>