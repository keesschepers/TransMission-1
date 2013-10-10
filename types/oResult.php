<?php

/**
 * @file
 * Contains the oResult data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';
include_once 'oError.php';

/**
 * Defines the oResult data type used for authentication.
 */
class oResult extends BaseType {
  /**
   * A summary of the result of the operation in Dutch.
   */
  public $result;

  /**
   * An array of errors that occurred.
   */
  public $aError;

  /**
   * A base64 encoded file containing the labels for the imported jobs.
   */
  public $labels;

   /**
   * Create a JPResult\TransMission\types\oResult object.
   *
   * Creates an instance of JPResult\TransMission\types\oResult, making sure
   * that errors are instantiated as oError classes.
   *
   * @param array $data
   *   (optional) An associative array defining the values to set on the new
   *   object's properties. The value of each property of the class is set to
   *   the value of the array item by the same name. Error objects, if in the
   *   form of arrays, will be converted to the correct class.
   */
  function __construct(array $data = array()) {
    // Convert errors to oError objects.
    if (isset($data['aError'])) {
      foreach ($data['aError'] as $index => $oError) {
        if (!(is_object($oError) && $oError instanceof oError)) {
          $data['aError'][$index] = new oError((array) $oError);
        }
      }
    }

    parent::__construct($data);
  }

  /**
   * Get the decoded PDF file used to label the shipments.
   *
   * @return string
   *   The decoded PDF file.
   */
  public function getLabels() {
    return base64_decode($this->labels);
  }
}
