<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace samuferenc\CodeGenerator;

/**
 * Description of Log
 *
 * @author samuferenc
 */
class Log
{

  const Info = "INFO";
  const Warning = "WARNING";
  const Error = "ERROR";

  public static function Debug($message, $level = self::Info)
  {
    echo sprintf("%s %s\n", $level, $message);
  }

  /**
   * 
   * @param string $msg
   * @param string|null $params
   */
  public static function Info($message, $params)
  {
    return;
    self::prepareMessage(func_get_args(), $message);
    self::Debug($message, self::Info);
  }  
  
  /**
   * 
   * @param string $msg
   * @param string|null $params
   */
  public static function Warning($message, $params)
  {
    self::prepareMessage(func_get_args(), $message);
    self::Debug($message, self::Warning);
  }

  /**
   * 
   * @param string $msg
   * @param string|null $params
   */
  public static function Error($message, $params)
  {
    self::prepareMessage(func_get_args(), $message);
    self::Debug($message, self::Error);
  }
  
  private static function prepareMessage($args, &$message)
  {
    if (count($args) > 1)
    {
      array_shift($args);
      $message = vsprintf($message, $args);
    }
  }
}
