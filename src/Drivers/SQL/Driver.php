<?php

namespace samuferenc\CodeGenerator\Drivers\SQL;

use samuferenc\CodeGenerator\CodeGenerator;
use samuferenc\CodeGenerator\Drivers\BaseDriver;
use samuferenc\CodeGenerator\Element\Type;

/**
 * Description of Driver
 *
 * @author virtual
 */
class Driver extends BaseDriver
{
  const Column = "Column";

  public function includeGenerator(CodeGenerator $codeGenerator)
  {
    parent::includeGenerator($codeGenerator);
    $this->codeGenerator->RegistrationParam(self::Column);
  }

  private function getColumnParams($text)
  {
    $result = array();
    
    foreach(explode(',', $text) as $block)
    {
      list($key, $value) = explode('=', $block);
      $result[trim($key)] = trim(trim($value), '"');
    }
    
    return $result;
  }
  
  public function GenOutput()
  {
    $tables = array();
    foreach($this->codeGenerator->getClasses() as $class)
    {
      $columns = array();
      
      if ($class->hasChild())
      {
        foreach ($class->getChildElements() as $element)
        {
          if ($element->getType() == Type::PropertyElement)
          {
            $columnText = $element->getAttribute(self::Column);
            if ($columnText != null)
            {
              $column = $this->getColumnParams(substr($columnText, 1, -1));
              $column['name'] = $element->getName();
              $columns[] = $column;
            }                               
          }          
        }
        
        if (count($columns) > 0)
          $tables[$class->getName()] = array("name" => $class->getName(), "columns" => $columns);        
      }
    }

  }
}
