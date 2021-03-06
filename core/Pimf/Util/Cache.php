<?php
/**
 * Pimf_Util
 *
 * PHP Version 5
 *
 * A comprehensive collection of PHP utility classes and functions
 * that developers find themselves using regularly when writing web applications.
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
 * Instant caching into a file at you local system.
 *
 * <code>
 *
 * $data = 'some sample data here, as string, array or object!';
 *
 * Pimf_Cache::cache('my.data.cache.id', $data);
 *
 * $hasData = Pimf_Cache::cache('my.data.cache.id');
 *
 * if ($hasData !== null) {
 *   $data = $hasData
 * }
 * </code>
 *
 * @package Pimf_Util
 * @author Gjero Krsteski <gjero@krsteski.de>
 */
class Pimf_Util_Cache
{
  /**
   * Reads/writes temporary data to cache files.
   *
   * @param string $path File path within /tmp to save the file - make sure it exists and is writeable.
   * @param mixed $data The data to save to the temporary file.
   * @param mixed $expires A valid strtotime string when the data expires.
   * @return mixed The contents of the temporary file.
   */
  public static function cache($path, $data = null, $expires = '+1 day')
  {
    $now      = time();
    $filename = strtolower($path);
    $fileTime = false;

    if (!is_numeric($expires)) {
      $expires = strtotime($expires, $now);
    }

    $timeDiff = $expires - $now;

    if (file_exists($filename)) {
      $fileTime = @filemtime($filename);
    }

    if ($data === null) {

      if (file_exists($filename) && $fileTime !== false) {

        if ($fileTime + $timeDiff < $now) {

          @unlink($filename);

        } else {

          $data = @file_get_contents($filename);

          if (Pimf_Util_String::isSerialized($data) === true) {
            $data = Pimf_Util_Serializer::unserialize($data);
          }
        }
      }
    } elseif (is_writable(dirname($filename))) {

      if (!is_string($data)) {
        $data = Pimf_Util_Serializer::serialize($data);
      }

      @file_put_contents($filename, $data, LOCK_EX);
    }

    return $data;
  }
}
