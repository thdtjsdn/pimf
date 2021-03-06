<?php
/**
 * Pimf_Pdo
 *
 * PHP Version 5
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://krsteski.de/new-bsd-license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to gjero@krsteski.de so we can send you a copy immediately.
 *
 * @copyright Copyright (c) 2010-2011 Gjero Krsteski (http://krsteski.de)
 * @license http://krsteski.de/new-bsd-license New BSD License
 */

/**
 * Creates a PDO connection from the farm of connectors.
 *
 * @package Pimf_Pdo
 * @author Gjero Krsteski <gjero@krsteski.de>
 */
class Pimf_Pdo_Factory
{
  /**
   * @param array $config
   * @return Pimf_Pdo
   * @throws RuntimeException
   * @throws UnexpectedValueException
   */
  public static function get(array $config)
  {
    if (!isset($config['driver'])) {
      throw new RuntimeException('no driver specified');
    }

    $driver = strtolower($config['driver']);

    if (!in_array($driver, array('sqlite', 'mysql', 'sqlserver', 'postgre'))) {
      throw new UnexpectedValueException('driver "'.$driver.'" not supported by PIMF');
    }

    $driver = 'Pimf_Pdo_'.ucfirst($driver);

    $pdo = new $driver();

    return $pdo->connect($config);
  }
}
