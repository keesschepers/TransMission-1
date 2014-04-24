<?php

/**
 * @file
 * Contains the Plus data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the Plus data type used to describe TransMission's "Plus" services.
 */
class Plus extends BaseType {
  /**
   * The code for the type of "Plus" service.
   *
   * @see JPResult\TransMission\TransMission::getDefinities()
   */
  public $kode;

  /**
   * (optional) The reference of the "Plus" service, useful to identify it.
   */
  public $referentie;
}
