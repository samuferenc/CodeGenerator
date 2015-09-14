<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator;

/**
 * Description of PHPParser
 *
 * @author virtual
 */
class PHPParser
{

  private $tokenscount = 0;
  private $tokens;
  public $namespace;
  public $classes = array();

  public function __construct($filename, $maxClass = 1)
  {
    $this->tokens = token_get_all(file_get_contents($filename));

    $this->tokenscount = count($this->tokens);
    $i = 0;
    while ($i < $this->tokenscount)
    {
      switch ($this->tokens[$i][0])
      {
        case T_NAMESPACE:         // 381
          $this->parseNamespace($i);
          break;
        case T_CLASS:             // 354
          $this->parseClass($i);
          if (count($this->classes) >= $maxClass)
            return;
          break;
      }

      $i++;
    }
  }

  private function parseNamespace(&$index)
  {
    $namespace = '';
    $namespaceComponents = array(
        T_NS_SEPARATOR,           // 384
        T_STRING                  // 307
    );

    $index += 2;                  // T_NAMESPACE + EMPTY
    while ($index < $this->tokenscount && in_array($this->tokens[$index][0], $namespaceComponents))
    {
      $namespace .= $this->tokens[$index][1];
      $index++;
    }

    $this->namespace = $namespace;
  }

  private function parseClass(&$index)
  {
    $index++;                     // T_CLASS
    while ($index < $this->tokenscount)
    {
      if ($this->tokens[$index][0] == T_STRING)
      {
        $this->classes[] = $this->tokens[$index][1];
        break;
      }
      $index++;
    }
  }

}

?>