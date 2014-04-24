<?php

/**
 * @file
 * Contains the Regel data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the Regel data type used to describe a shipping unit.
 */
class Regel extends BaseType {
  /**
   * The autoincrementing ID of the shipping unit.
   */
  public $nrcollo;

  /**
   * The type of shipping unit.
   *
   * @see JPResult\TransMission\TransMission::getDefinities()
   */
  public $vrzenh;

  /**
   * (optional) The amount of items packaged in this shipping unit.
   */
  public $aantalop;

  /**
   * The weight of the shipping unit in kg.
   */
  public $gewicht;

  /**
   * (optional) The length of the shipping unit in cm.
   */
  public $lengte;

  /**
   * (optional) The width of the shipping unit in cm.
   */
  public $breedte;

  /**
   * (optional) The height of the shipping unit in cm.
   */
  public $hoogte;

  /**
   * (optional) The reference of the shipping unit, useful to identify it.
   */
  public $referentie;

  /**
   * (optional) The description of the shipping unit.
   */
  public $omsverp;

  /**
   * (optional) Indicates whether a EUR-pallet should be exchanged.
   */
  public $omruilen;
}
