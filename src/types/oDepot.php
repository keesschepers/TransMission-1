<?php

/**
 * @file
 * Contains the oDepot data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the oDepot data type used to describe TransMission depots.
 */
class oDepot extends BaseType {
  /**
   * The depot ID.
   */
  public $depot;

  /**
   * The name of the depot.
   */
  public $naam;

  /**
   * The street address.
   */
  public $straat;

  /**
   * The house number.
   */
  public $huisnummer;

  /**
   * The postal code.
   */
  public $postcode;

  /**
   * The city.
   */
  public $plaats;

  /**
   * The country.
   */
  public $land;

  /**
   * The phone number.
   */
  public $telefoon;

  /**
   * The email address.
   */
  public $email;
}
