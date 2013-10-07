<?php

/**
 * @file
 * Contains the LandDef data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the LandDef data type used to describe data of countries.
 */
class LandDef extends BaseType {
  /**
   * TransMission's unique code of the country.
   */
  public $TMSKode;

  /**
   * The ISO 3166 country code.
   */
  public $AltKode;

  /**
   * The name of the country in Dutch.
   */
  public $Omschrijving;

  /**
   * The maximum weight in kg that can be shipped to the country.
   */
  public $MaxGewicht;

  /**
   * The maximum amount that may be collected on delivery to the country.
   */
  public $MaxRembours;
}
