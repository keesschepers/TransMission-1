<?php

/**
 * @file
 * Contains the exceptions class of the TransMission library.
 */

namespace JPResult\TransMission;

/**
 * Extends the Exception class.
 *
 * This is used to throw exceptions specific to TransMission's SOAP service.
 * Possible errors are:
 * - Incorrect login details
 *   Indicates that the provided login information in incorrect or incomplete.
 * - 
 */
class TransMissionFault extends \Exception {
  /**
   * Parses TransMission's error and creates a TransMissionFault object.
   */
  function __construct(\SoapFault $previous) {
    // Use the same error code as the SoapFault.
    $code = $previous->faultcode;

    switch ($previous->getMessage()) {
      case 'Onjuiste inloggegevens':
        $message = 'Incorrect login details';
        break;

      case 'Opslaan nieuwe opdracht niet gelukt':
        $message = 'TODO!'; // @todo
        break;

      case 'Opdracht niet gevonden':
        $message = 'TODO!'; // @todo
        break;

      case 'Opdracht kan niet worden verwijderd':
        $message = 'TODO!'; // @todo
        break;

      case 'Opgevraagde labels niet gevonden':
        $message = 'TODO!'; // @todo
        break;

      case 'Geen openstaande opdrachten':
        $message = 'TODO!'; // @todo
        break;

      case 'Onjuist depot':
        $message = 'TODO!'; // @todo
        break;

      case 'Er zijn geen ETA tijden bekend':
        $message = 'TODO!'; // @todo
        break;

      case 'Geen opdrachten gevonden':
        $message = 'TODO!'; // @todo
        break;

      case 'Onjuiste postcode (Moet bestaan uit 4 cijfers, 2 letters)':
        $message = 'TODO!'; // @todo
        break;

      case 'Er is geen adres gevonden op deze postcode':
        $message = 'TODO!'; // @todo
        break;

      default:
        $message = 'An unknown error occurred';
    }

    parent::__construct($message, $code, $previous);
  }
}
