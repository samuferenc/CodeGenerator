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

  const Info = "info";
  const Warning = "warning";
  const Error = "error";

  public static function Debug($message, $level = self::Info)
  {
    echo sprintf("%s: %s\n", $message, $level);
  }

  /**
   * 
   * @param string $msg
   * @param string|null $params
   */
  public static function Info($message, $params)
  {
    $paramCount = func_num_args();
    if ($paramCount > 1)
    {
      $message = vsprintf($message, func_get_args());
    }

    self::Debug($message, self::Info);
  }  
  
  /**
   * 
   * @param string $msg
   * @param string|null $params
   */
  public static function Warning($message, $params)
  {
    $paramCount = func_num_args();
    if ($paramCount > 1)
    {
      $message = vsprintf($message, func_get_args());
    }

    self::Debug($message, self::Warning);
  }

  /**
   * 
   * @param string $msg
   * @param string|null $params
   */
  public static function Error($message, $params)
  {
    $paramCount = func_num_args();
    if ($paramCount > 1)
    {
      $message = vsprintf($message, func_get_args());
    }

    self::Debug($message, self::Error);
  }

}
