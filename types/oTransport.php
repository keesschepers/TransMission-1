<?php

/**
 * @file
 * Contains the oTransport data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the oTransport data type used to identify a remote shipping job.
 */
class oTransport extends BaseType {
  /**
   * The unique shipping code.
   */
  public $zendingnr;

  /**
   * @todo Undocumented, purpose not clear. Perhaps depot-specific?
   */
  public $nrdepaan;

  /**
   * A base64 encoded PDF file to be used to label the shipment.
   */
  public $labels;

  /**
   * Returns the decoded PDF file used to label the shipment.
   *
   * @return string
   *   The decoded PDF file.
   */
  public function getLabels() {
    return base64_decode($this->labels);
  }
}
