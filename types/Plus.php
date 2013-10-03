<?php

/**
 * @file
 * Contains the Plus data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the Plus data type used to describe TransMission's "Plus" services.
 */
class Plus extends BaseType {
  /**
   * The code for the type of "Plus" service.
   * @todo Refer to the function returning the service types.
   */
  public $kode;

  /**
   * (optional) The reference of the "Plus" service, useful to identify it.
   */
  public $referentie;
}
