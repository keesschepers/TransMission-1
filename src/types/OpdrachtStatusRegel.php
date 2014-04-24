<?php

/**
 * @file
 * Contains the OpdrachtStatusRegel data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the OpdrachtStatusRegel data type used to describe job unit statuses.
 */
class OpdrachtStatusRegel extends BaseType {
  /**
   * The ID of the shipping unit.
   */
  public $Nrcollo;

  /**
   * The unique code of the shipping unit.
   */
  public $Barcode;

  /**
   * (optional) The weight of the shipping unit.
   */
  public $Mgewicht;

  /**
   * (optional) The length of the shipping unit.
   */
  public $Mlengte;

  /**
   * (optional) The width of the shipping unit.
   */
  public $Mbreedte;

  /**
   * (optional) The height of the shipping unit.
   */
  public $Mhoogte;

  /**
   * (optional) The volume of the shipping unit.
   */
  public $Mvolm3;

  /**
   * (optional) An array of status mutations of the shipping unit.
   */
  public $aRegelHistorie;

  /**
   * Create a JPResult\TransMission\types\OpdrachtStatusRegel object.
   *
   * Creates an instance of JPResult\TransMission\types\OpdrachtStatusRegel,
   * making sure that mutation objects are instantiated as RegelHistorie
   * classes.
   *
   * @param array $data
   *   (optional) An associative array defining the values to set on the new
   *   object's properties. The value of each property of the class is set to
   *   the value of the array item by the same name. Status mutation objects, if
   *   in the form of arrays, will be converted to the correct class.
   */
  function __construct(array $data = array()) {
    // Convert status mutations to RegelHistorie objects.
    if (isset($data['aRegelHistorie'])) {
      foreach ($data['aRegelHistorie'] as $index => $RegelHistorie) {
        if (!(is_object($RegelHistorie) && $RegelHistorie instanceof RegelHistorie)) {
          $data['aRegelHistorie'][$index] = new RegelHistorie((array) $RegelHistorie);
        }
      }

      // Sort the status mutation objects.
      usort($data['aRegelHistorie'], 'self::mutationSort');
    }

    parent::__construct($data);
  }

  /**
   * Callback of usort() to sort status mutations based on date and time.
   */
  protected function mutationSort($a, $b) {
    // Status 0 must be the last one.
    if ($a->Status == 0) {
      return 1;
    }
    elseif ($b->Status == 0) {
      return -1;
    }

    return strcmp($a->Datum . $a->Tijd, $b->Datum . $b->Tijd);
  }
}
