<?php

/**
 * @file
 * Contains the OpdrachtStatus data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the OpdrachtStatus data type used to describe shipping job states.
 */
class OpdrachtStatus extends BaseType {
  /**
   * The unique code of the shipping job.
   */
  public $Zendingnummer;

  /**
   * Indentifier of the order corresponding to the shipping job.
   */
  public $Nrorder;

  /**
   * An array of recipient signatures.
   */
  public $aHandtekening;

  /**
   * The date the shipping job is planned to be delivered.
   */
  public $Plandatum;

  /**
   * The earliest time the shipping job is planned to be delivered.
   */
  public $Plantijdvan;

  /**
   * The last time the shipping job is planned to be delivered.
   */
  public $Plantijdtot;

  /**
   * An array with all the status mutations of the shipping job.
   */
  public $aOpdrachtStatusRegel;

  /**
   * Create a JPResult\TransMission\types\OpdrachtStatus object.
   *
   * Creates an instance of JPResult\TransMission\types\OpdrachtStatus, making
   * sure that recipient sigantures and job unit statuses are instantiated as
   * their respective classes.
   *
   * @param array $data
   *   (optional) An associative array defining the values to set on the new
   *   object's properties. The value of each property of the class is set to
   *   the value of the array item by the same name. Recipient signature objects
   *   and job unit status objects, if in the form of arrays, will be converted
   *   to the correct classes.
   */
  function __construct(array $data = array()) {
    // Convert recipient signatures to Handtekening objects.
    if (isset($data['aHandtekening'])) {
      foreach ($data['aHandtekening'] as $index => $Handtekening) {
        if (!(is_object($Handtekening) && $Handtekening instanceof Handtekening)) {
          $data['aHandtekening'][$index] = new Handtekening((array) $Handtekening);
        }
      }
    }

    // Convert job unit statuses to OpdrachtStatusRegel objects.
    if (isset($data['aOpdrachtStatusRegel'])) {
      foreach ($data['aOpdrachtStatusRegel'] as $index => $OpdrachtStatusRegel) {
        if (!(is_object($OpdrachtStatusRegel) && $OpdrachtStatusRegel instanceof OpdrachtStatusRegel)) {
          $data['aOpdrachtStatusRegel'][$index] = new OpdrachtStatusRegel((array) $OpdrachtStatusRegel);
        }
      }
    }

    parent::__construct($data);
  }
}
