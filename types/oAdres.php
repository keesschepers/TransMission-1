<?php

/**
 * @file
 * Contains the oAdres data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the oAdres data type used to describe an address.
 */
class oAdres extends BaseType {
  /**
   * The streetname.
   */
  public $straat;

  /**
   * The postal code.
   */
  public $postcode;

  /**
   * The city.
   */
  public $plaats;
}
