<?php

/**
 * @file
 * Contains the oAktueleOpdracht data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the oAktueleOpdracht data type used to describe.
 */
class oAktueleOpdracht extends BaseType {
  /**
   * The ID of the shipping job.
   */
  public $opdrachtid;

  /**
   * Indentifier of the order corresponding to the shipping job.
   */
  public $nrorder;

  /**
   * Boolean indicating whether the shipping job has been printed yet.
   */
  public $geprint;
}
