<?php

/**
 * @file
 * Contains the oBestand data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the oBestand data type used to describe spreadsheets for importing.
 */
class oBestand extends BaseType {
  /**
   * The type of import. Must be one of:
   * - "opdracht" => To import shipping jobs.
   * - "OpdrachtRegel" => To import shipping job units.
   * - "desadv" => Unknown.
   *
   * @todo What does "desadv" mean.
   */
  public $type;

  /**
   * The base64 encoded content of the file.
   */
  public $bestand;

  /**
   * The file's extension. Must be one of:
   * - "xls" => An excel sheet. Does not appear to work properly.
   * - "csv" => A comma-separated values file, using semicolon as delimiter.
   *
   * @todo Verify that excel sheets don't work.
   */
  public $extentie;
}
