<?php

/**
 * @file
 * Contains the VrzenhDef data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the VrzenhDef data type used to describe data of shipping unit types.
 */
class VrzenhDef extends BaseType {
  /**
   * TransMission's unique code of the shipping unit type.
   */
  public $TMSKode;

  /**
   * The description of the shipping unit type in Dutch.
   */
  public $Omschrijving;

  /**
   * (optional) The length of the shipping unit type.
   */
  public $Lengte;

  /**
   * (optional) The width of the shipping unit type.
   */
  public $Breedte;

  /**
   * (optional) The maximum length of the shipping unit type.
   */
  public $MaxLengte;

  /**
   * (optional) The maximum height of the shipping unit type.
   */
  public $MaxHoogte;

  /**
   * (optional) The maximum weight of the shipping unit type.
   */
  public $MaxGewicht;
}
