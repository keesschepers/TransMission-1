<?php

/**
 * @file
 * Contains the oDefinitie data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';
include_once 'LandDef.php';
include_once 'ZndSrtDef.php';
include_once 'PlusDef.php';
include_once 'VrzenhDef.php';

/**
 * Defines the oDefinitie data type used to describe some definitions.
 *
 * An oDefinitie object describes a number of TransMission's definitions and
 * their details.
 */
class oDefinitie extends BaseType {
  /**
   * An array of country definitions.
   *
   * @see JPResult\TransMission\types\LandDef
   */
  public $aLandDef;

  /**
   * An array of shipping type definitions.
   *
   * @see JPResult\TransMission\types\ZndSrtDef
   */
  public $aZndSrtDef;

  /**
   * An array of "Plus" service definitions.
   *
   * @see JPResult\TransMission\types\PlusDef
   */
  public $aPlusDef;

  /**
   * An array of shipping unit type definitions.
   *
   * @see JPResult\TransMission\types\VrzenhDef
   */
  public $aVrzenhDef;

  /**
   * Create a JPResult\TransMission\types\oDefinitie object.
   *
   * Creates an instance of JPResult\TransMission\types\oDefinitie, making sure
   * that country definitions, shipping type definitions, "Plus" service
   * definitions and shipping unit type definitions are instantiated as their
   * respective classes.
   *
   * @param array $data
   *   (optional) An associative array defining the values to set on the new
   *   object's properties. The value of each property of the class is set to
   *   the value of the array item by the same name. Country definition objects,
   *   shipping type definition objects, "Plus" service definition objects and
   *   shipping unit type definition objects, if in the form of arrays, will be
   *   converted to the correct classes.
   */
  function __construct(array $data = array()) {
    // Convert country definitions to LandDef objects.
    if (isset($data['aLandDef'])) {
      foreach ($data['aLandDef'] as $index => $LandDef) {
        if (!(is_object($LandDef) && $LandDef instanceof LandDef)) {
          $data['aLandDef'][$index] = new LandDef((array) $LandDef);
        }
      }
    }

    // Convert shipping type definitions to ZndSrtDef objects.
    if (isset($data['aZndSrtDef'])) {
      foreach ($data['aZndSrtDef'] as $index => $ZndSrtDef) {
        if (!(is_object($ZndSrtDef) && $ZndSrtDef instanceof ZndSrtDef)) {
          $data['aZndSrtDef'][$index] = new ZndSrtDef((array) $ZndSrtDef);
        }
      }
    }

    // Convert "Plus" service definitions to ZndSrtDef objects.
    if (isset($data['aPlusDef'])) {
      foreach ($data['aPlusDef'] as $index => $PlusDef) {
        if (!(is_object($PlusDef) && $PlusDef instanceof PlusDef)) {
          $data['aPlusDef'][$index] = new PlusDef((array) $PlusDef);
        }
      }
    }

    // Convert shipping unit type definitions to ZndSrtDef objects.
    if (isset($data['aVrzenhDef'])) {
      foreach ($data['aVrzenhDef'] as $index => $VrzenhDef) {
        if (!(is_object($VrzenhDef) && $VrzenhDef instanceof VrzenhDef)) {
          $data['aVrzenhDef'][$index] = new VrzenhDef((array) $VrzenhDef);
        }
      }
    }

    parent::__construct($data);
  }
}
