<?php

/**
 * @file
 * Contains the Handtekening data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the Handtekening data type used for describe recipient details.
 */
class Handtekening extends BaseType {
  /**
   * The hexadecimal representation of the magic number of PNG files.
   */
  const PNG_MAGIC_NUMBER = '89504E470D0A1A0A';

  /**
   * The date the shipping job unit was delivered.
   */
  public $Datum;

  /**
   * The time the shipping job unit was delivered.
   */
  public $Tijd;

  /**
   * The name of the recipient.
   */
  public $Naam;

  /**
   * The base64 encoded PNG file of the recipient's signature.
   */
  public $Handtekening;

  /**
   * Get the decoded PNG file containing the recipient's signature.
   *
   * @return string
   *   The decoded PNG file or an empty string when decoding failed.
   *
   * @todo The PNG file is encoded twice, which is a bug. When that is fixed,
   * this function will still work as it is forward compatible.
   */
  function getHandtekening() {
    $signature = $this->Handtekening;

    // Recursively decode the file contents until a PNG file is identified.
    while (strpos($signature, pack('H*', self::PNG_MAGIC_NUMBER)) !== 0 && strlen($signature)) {
      $signature = base64_decode($signature);
    }

    return $signature;
  }
}
