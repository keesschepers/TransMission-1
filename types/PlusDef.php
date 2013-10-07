<?php

/**
 * @file
 * Contains the PlusDef data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the PlusDef data type used to describe data of "Plus" services.
 */
class PlusDef extends BaseType {
  /**
   * TransMission's unique code of the "Plus" service.
   */
  public $TMSKode;

  /**
   * The description of the "Plus" service in Dutch.
   */
  public $Omschrijving;

  /**
   * TransMission's unique code of the country the "Plus" service applies to.
   */
  public $LandKode;
}
