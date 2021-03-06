<?php
class Pimf_LoggerTest extends PHPUnit_Framework_TestCase
{
  private static $localeStorageDir;

  public static function setUpBeforeClass()
  {
    self::$localeStorageDir = dirname(__FILE__) . '/_drafts/';
  }

  public static function tearDownAfterClass()
  {
    @unlink(self::$localeStorageDir . 'pimf-logs.txt');
    @unlink(self::$localeStorageDir . 'pimf-warnings.txt');
    @unlink(self::$localeStorageDir . 'pimf-errors.txt');
  }

  #tests

  public function testCreatingNewInstanceAndDestructingIt()
  {
    new Pimf_Logger(self::$localeStorageDir);
  }

  public function testCreatingNewInstanceWithTrailingSeparatorAndDestructingIt()
  {
    new Pimf_Logger(self::$localeStorageDir, true);
  }

  public function testInitialisingTheFileResources()
  {
    $logger = new Pimf_Logger(self::$localeStorageDir);

    $logger->init();
  }

  public function testLoggingMethods()
  {
    $logger = new Pimf_Logger(self::$localeStorageDir);
    $logger->init();

    $logger->debug('debug msg')->error('error msg')->info('info msg')->warn('warn msg');
  }
}
