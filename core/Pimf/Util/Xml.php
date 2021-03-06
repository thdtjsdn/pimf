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
 * An XML util for converting XML to DOMDocument or SimpleXMLElement or to Array.
 *
 * @package Pimf_Util
 * @author Gjero Krsteski <gjero@krsteski.de>
 */
class Pimf_Util_Xml
{
  /**
   * Convert anything DOMDocument|SimpleXMLElement|string to DOMDocument.
   * @param DOMDocument|SimpleXMLElement|string $xml String may be filename or xml string
   * @throws InvalidArgumentException
   * @return DOMDocument
   */
  public function toDOMDocument($xml)
  {
    if ($xml instanceof DOMDocument) {
      // parameter is DOMDocument
      return $xml;
    }

    if ($xml instanceof SimpleXMLElement) {
      $doc = new DOMDocument();
      $doc->load($xml->asXML());

      return $doc;
    }

    if (is_string($xml)) {
      $doc = new DOMDocument();

      if (is_file($xml)) {
          // parameter is file name
          $doc->load($xml);

          return $doc;
      }

      // parameter is xml string
      $doc->loadXML($xml);

      return $doc;
    }

    $type = is_object($xml) ? get_class($xml) : gettype($xml);

    throw new InvalidArgumentException(
      "Cannot convert instance of '$type' to DOMDocument"
    );
  }

  /**
   * Convert anything DOMDocument|SimpleXMLElement|string to SimpleXMLElement.
   * @param DOMDocument|SimpleXMLElement|string $xml String may be filename or xml string
   * @throws InvalidArgumentException
   * @return SimpleXMLElement
   */
  public function toSimpleXMLElement($xml)
  {
    if ($xml instanceof SimpleXMLElement) {
      // parameter is DOMDocument
      return $xml;
    }

    if ($xml instanceof DOMDocument) {
      return simplexml_import_dom($xml);
    }

    if (is_string($xml)) {

      if (is_file($xml)) {
        // parameter is file name
        return simplexml_load_file($xml);
      }

      // parameter is xml string
      return simplexml_load_string($xml);
    }

    $type = is_object($xml) ? get_class($xml) : gettype($xml);

    throw new InvalidArgumentException(
    	"Cannot convert instance of '$type' to DOMDocument"
    );
  }

  /**
   * Convert SimpleXMLElement to multidimensional array.
   * @param SimpleXMLElement $xml
   * @param string $namespace The namespace that schould be used.
   * @throws OutOfBoundsException If namespace not found in the xml.
   * @return array
   */
  public function toArray(SimpleXMLElement $xml, $namespace = null)
  {
    if ($namespace !== null) {

      $namespaces = $xml->getNamespaces();

      if (false === isset($namespaces[$namespace])) {
        throw new OutOfBoundsException(
          'namespace ['.$namespace.'] not found'
        );
      }

      $xml = $xml->children($namespaces[$namespace]);
    }

    return json_decode(
      json_encode($xml), true
    );
  }
}
