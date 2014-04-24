<?php

/**
 * @file
 * Contains the oTransport data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Defines the oTransport data type used to identify a remote shipping job.
 */
class oTransport extends BaseType {
  /**
   * The unique shipping code.
   */
  public $zendingnr;

  /**
   * ID of the depot that will be supplied with the shipment.
   */
  public $nrdepaan;

  /**
   * A base64 encoded PDF file to be used to label the shipment.
   */
  public $labels;

  /**
   * Get the decoded PDF file used to label the shipment.
   *
   * @return string
   *   The decoded PDF file.
   */
  public function getLabels() {
    return base64_decode($this->labels);
  }
}
