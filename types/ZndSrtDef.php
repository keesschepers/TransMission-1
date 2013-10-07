<?php

/**
 * @file
 * Contains the ZndSrtDef data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the ZndSrtDef data type used to describe data of shipping types.
 */
class ZndSrtDef extends BaseType {
  /**
   * TransMission's unique code of the shipping type.
   */
  public $TMSKode;

  /**
   * The description of the shipping type in Dutch.
   */
  public $Omschrijving;

  /**
   * Whether collect on delivery is possible for the shipping type.
   */
  public $Rembours;
}
