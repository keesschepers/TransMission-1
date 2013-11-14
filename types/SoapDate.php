<?php

/**
 * @file
 * Contains the SoapDate data type used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * A class extending the DateTime class to be able to use it in a SOAP context.
 */
class SoapDate extends \DateTime {
  /**
   * The date format used by the SOAP protocol.
   */
  const DATE_FORMAT = 'Y-m-d H:m:s';

  /**
   * The timezone used by TransMission's SOAP service.
   */
  const TIMEZONE = 'Europe/Amsterdam';

  /**
   * Converts the object to a string so it can be embedded in SOAP requests.
   */
  function __toString() {
    return $this->setTimezone(new \DateTimeZone(self::TIMEZONE))->format(self::DATE_FORMAT);
  }
}
