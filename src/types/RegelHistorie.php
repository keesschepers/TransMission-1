<?php

/**
 * @file
 * Contains the RegelHistorie data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the RegelHistorie data type used to describe job status mutations.
 */
class RegelHistorie extends BaseType {
  /**
   * The date of the status mutation.
   */
  public $Datum;

  /**
   * The time of the status mutation.
   */
  public $Tijd;

  /**
   * The depot responsible for the status mutation.
   */
  public $Depot;

  /**
   * TransMission's status code for the status mutation.
   */
  public $Status;

  /**
   * The description of the status mutation in Dutch.
   */
  public $Omschrijving;

  /**
   * Get the creation time of the status mutation.
   *
   * return JPResult\TransMission\types\SoapDate
   *   The time the status mutation was created.
   */
  function getTime() {
    return new SoapDate("{$this->Datum} {$this->Tijd}", new \DateTimeZone(SoapDate::TIMEZONE));
  }
}
