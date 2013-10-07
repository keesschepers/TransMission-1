<?php

/**
 * @file
 * Contains the oOpdracht data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';
include_once 'Plus.php';
include_once 'Regel.php';

/**
 * Defines the oOpdracht data type used to describe a shipping job.
 */
class oOpdracht extends BaseType {
  /**
   * The type of shipment.
   * @todo refer to the function that returns the available shipment types.
   */
  public $type;

  /**
   * (optional) Indentifier of the order corresponding to the shipping job.
   */
  public $nrorder;

  /**
   * (optional) The date the shipment should be initiated. Defaults to today.
   */
  public $datum;

  /**
   * The identifier of the sender address from the remote addressbook.
   */
  public $afzender;

  /**
   * (optional) Person or company name, part of the sender's address.
   */
  public $afznaam;

  /**
   * (optional) Company representative name, part of the sender's address.
   */
  public $afznaam2;

  /**
   * (optional) Street name, part of the sender's address
   */
  public $afzastraat;

  /**
   * (optional) House number, part of the sender's address.
   */
  public $afzhuisnr;

  /**
   * (optional) Postal code, part of the sender's address.
   */
  public $afzpostcode;

  /**
   * (optional) City name, part of the sender's address.
   */
  public $afzplaats;

  /**
   * (optional) The ISO 3166 country code, part of the sender's address.
   */
  public $afzland;

  /**
   * Person or company name, part of the receiver's address.
   */
  public $geanaam;

  /**
   * (optional) Company representative name, part of the receiver's address.
   */
  public $geanaam2;

  /**
   * Street name, part of the receiver's address.
   */
  public $geastraat;

  /**
   * House number, part of the receiver's address.
   */
  public $geahuisnr;

  /**
   * Postal code, part of the receiver's address.
   */
  public $geapostcode;

  /**
   * City name, part of the receiver's address.
   */
  public $geaplaats;

  /**
   * ISO 3166 country code, part of the receiver's address.
   */
  public $gealand;

  /**
   * (optional) Phone number, part of the receiver's address.
   */
  public $geatelefoon;

  /**
   * (optional) Email address, part of the receiver's address.
   */
  public $geaemail;

  /**
   * (optional) A delivery instruction.
   */
  public $instructie;

  /**
   * (optional) The amount of money that should be collected on delivery.
   */
  public $rembours;

  /**
   * (optional) Array of "Plus" service items.
   * @todo refer to the function that returns the available "Plus" services.
   *
   * @see JPResult\TransMission\types\Plus
   */
  public $aPlus;

  /**
   * Array of shipping units.
   *
   * @see JPResult\TransMission\types\Regel
   */
  public $aRegel;

  /**
   * Create a JPResult\TransMission\types\oOpdracht object.
   *
   * Creates an instance of JPResult\TransMission\types\oOpdracht, making sure
   * that "Plus" services and shipping units are instantiated as their
   * respective classes.
   *
   * @param array $data
   *   (optional) An associative array defining the values to set on the new
   *   object's properties. The value of each property of the class is set to
   *   the value of the array item by the same name. "Plus" service objects and
   *   shipping unit objects, if in the form of arrays, will be converted to the
   *   correct classes.
   *
   * @todo Date should be created with a unix timestamp.
   */
  function __construct(array $data = array()) {
    // Convert "Plus" services to Plus objects.
    if (isset($data['aPlus'])) {
      foreach ($data['aPlus'] as $index => $Plus) {
        if (!(is_object($Plus) && $Plus instanceof Plus)) {
          $data['aPlus'][$index] = new Plus((array) $Plus);
        }
      }
    }

    // Convert shipping units to Regel objects.
    if (isset($data['aRegel'])) {
      foreach ($data['aRegel'] as $index => $Regel) {
        if (!(is_object($Regel) && $Regel instanceof Regel)) {
          $data['aRegel'][$index] = new Regel((array) $Regel);
        }
      }
    }

    parent::__construct($data);
  }
}
