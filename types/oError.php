<?php

/**
 * @file
 * Contains the oError data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the oError data type used for describe file import errors.
 */
class oError extends BaseType {
  /**
   * The indentifier of the order corresponding to the shipping job.
   */
  public $nrorder;

  /**
   * The error that prevented importing of the item.
   */
  public $melding;
}
