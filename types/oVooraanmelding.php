<?php

/**
 * @file
 * Contains the oVooraanmelding data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the oVooraanmelding data type used to describe a notification.
 */
class oVooraanmelding extends BaseType {
  /**
   * The total amount of pallets.
   */
  public $pallet;

  /**
   * The total amount of packages.
   */
  public $colli;

  /**
   * The total weight in kg.
   */
  public $gewicht;
}
