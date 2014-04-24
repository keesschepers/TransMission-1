<?php

/**
 * @file
 * Contains the Pkgebied data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the Pkgebied data type used to describe a postal code range.
 */
class Pkgebied extends BaseType {
  /**
   * Start of the postal code range.
   */
  public $Pkvan;

  /**
   * End of the postal code range.
   */
  public $Pktot;

  /**
   * TransMission's unique code of the country to which the addresses belong.
   */
  public $Kdland;

  /**
   * Number of the depot that is repsonsible for the range.
   */
  public $Nrdepaan;
}
