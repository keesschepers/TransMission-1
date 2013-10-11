<?php

/**
 * @file
 * Contains the main class of the TransMission library.
 */

namespace JPResult\TransMission;

include_once 'TransMissionFault.php';

include_once 'types/oLogin.php';
include_once 'types/oOpdracht.php';
include_once 'types/oTransport.php';
include_once 'types/oDefinitie.php';
include_once 'types/SoapDate.php';
include_once 'types/oVooraanmelding.php';
include_once 'types/oAdres.php';
include_once 'types/Pkgebied.php';
include_once 'types/OpdrachtStatus.php';
include_once 'types/oBestand.php';
include_once 'types/oResult.php';
include_once 'types/oAktueleOpdracht.php';

use JPResult\TransMission\types\oLogin;
use JPResult\TransMission\types\oOpdracht;
use JPResult\TransMission\types\oTransport;
use JPResult\TransMission\types\oDefinitie;
use JPResult\TransMission\types\SoapDate;
use JPResult\TransMission\types\oVooraanmelding;
use JPResult\TransMission\types\oAdres;
use JPResult\TransMission\types\Pkgebied;
use JPResult\TransMission\types\OpdrachtStatus;
use JPResult\TransMission\types\oBestand;
use JPResult\TransMission\types\oResult;
use JPResult\TransMission\types\oAktueleOpdracht;

/**
 * Supplies an API to communicate with TransMission's SOAP service.
 */
class TransMission extends \SoapClient {

  /**
   * The URL of the SOAP service of TransMission's production environment.
   */
  const DEFAULT_WSDL = 'https://portal.trans-mission.nl/webservices/TMSOnline.wsdl';

  /**
   * The regex pattern to check whether delOpdracht() was successful.
   */
  const RESPONSE_REMOVE_SUCCESS = '/^Opdracht \w+ verwijderd$/';

  /**
   * The regex pattern to check whether sendOpdrachten() was successful.
   */
  const RESPONSE_SEND_SUCCESS = '/^Bestand aangemaakt$/';

  /**
   * The regex pattern to check whether addVooraanmelding() was successful.
   */
  const RESPONSE_NOTIFY_SUCCESS = '/^Bedankt voor de vooraanmelding$/';

  /**
   * The regex pattern to check whether updatePrintStatus() was successful.
   */
  const RESPONSE_PRINTSTATUS_SUCCESS = '/^Printstatus bijgewerkt$/';

  /**
   * The login object, used for authentication.
   */
  public $login;

  /**
   * Construct a TransMission object.
   *
   * @param JPResult\TransMission\types\oLogin $login
   *   Supplies the authentication details of the TransMission account.
   * @param $wsdl
   *   (optional) Supplies the URL of TransMission's SOAP service. Defaults to
   *   self::DEFAULT_WSDL.
   * @param $options
   *   (optional) Supplies the options to use for the SoapClient connection.
   *
   * @return JPResult\TransMission\TransMission
   *   The created TransMission object.
   */
  function __construct(oLogin $login, $wsdl = self::DEFAULT_WSDL, array $options = array()) {
    $this->login = $login;

    parent::__construct($wsdl, $options);
  }

  /**
   * Function used internally to call SoapClient with exception handling.
   */
  private function soapCall($call, $arguments) {
    try {
      $result = call_user_func_array('parent::' . $call, $arguments);
    }
    catch (\SoapFault $e) {
      throw new TransMissionFault($e);
    }

    return $result;
  }

  /**
   * Create a shipping job in TransMission.
   *
   * @param JPResult\TransMission\types\oOpdracht $oOpdracht
   *   The object describing the job to be created in TransMission.
   *
   * @return JPResult\TransMission\types\oTransport
   *   The transport object corresponding to the created shipping job.
   */
  public function addOpdracht(oOpdracht $oOpdracht) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return new oTransport((array) $response);
  }

  /**
   * Remove a job in TransMission.
   *
   * @param string $nrzend
   *   The unique code of the shipping job.
   *
   * @return bool
   *   Returns TRUE if successful, FALSE if unsuccessful.
   */
  public function delOpdracht($nrzend) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return (bool) preg_match(self::RESPONSE_REMOVE_SUCCESS, $response);
  }

  /**
   * Get a PDF file with the list of unsent shipping jobs.
   *
   * @return string
   *   The content of the PDF file.
   */
  public function getVerzendlijst() {
    // The only argument for this SOAP call is the login object.
    $arguments = array($this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return base64_decode($response);
  }

  /**
   * Get labels of multiple shipping jobs as a PDF file.
   *
   * @param array $aNrzend
   *   An array of unique codes of shipping jobs.
   *
   * @return string
   *   The content of the PDF file.
   */
  public function getLabels(array $aNrzend) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return base64_decode($response);
  }

  /**
   * Mark current shipping jobs as ready to be sent.
   *
   * @return bool
   *   TRUE when successful, FALSE when there are no unprocessed shipping jobs.
   */
  public function sendOpdrachten() {
    // The only argument for this SOAP call is the login object.
    $arguments = array($this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return (bool) preg_match(self::RESPONSE_SEND_SUCCESS, $response);
  }

  /**
   * Get definitions of a number of parameters in TransMission.
   *
   * Gets definitions of the following parameters used in TransMission:
   *   - Country
   *   - Shipping type
   *   - "Plus" service
   *   - Shipping unit type
   *
   * @return JPResult\TransMission\types\oDefinitie
   *   The object containing the definitions.
   */
  public function getDefinities() {
    // The only argument for this SOAP call is the login object.
    $arguments = array($this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return new oDefinitie((array) $response);
  }

  /**
   * Get status of all shipping jobs of a certain date.
   *
   * This function does not seem to work, as it returns bogus results.
   *
   * @param JPResult\TransMission\types\SoapDate $datum
   *   The send date of the shipping jobs of which to check the status.
   *
   * @return array
   *   An array containing all matching shipping jobs including their statuses.
   *
   * @todo This function seems to be defunct. Deprecated/removed?
   */
  public function getStatus(SoapDate $datum) {
    $arguments = array((string) $datum);

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return $response;
  }

  /**
   * Get ETA of all shipping jobs of a certain date.
   *
   * This function does not seem to work, as it returns bogus results.
   *
   * @param JPResult\TransMission\types\SoapDate $datum
   *   The send date of the shipping jobs of which to check the ETA.
   *
   * @return array
   *   An array containing all matching shipping jobs including their ETA's.
   *
   * @todo This function seems to be defunct. Deprecated/removed?
   */
  public function getETA(SoapDate $datum) {
    $arguments = array((string) $datum);

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return $response;
  }

  /**
   * Notify TransMission up front about shipping jobs.
   *
   * @param JPResult\TransMission\types\oVooraanmelding $oVooraanmelding
   *   The approximate nature and size of the shipment.
   *
   * @return bool
   *   TRUE when successful, FALSE when something went wrong.
   */
  public function addVooraanmelding(oVooraanmelding $oVooraanmelding) {
    $arguments = func_get_args();

    // Prepend the depot and client details to the list of arguments.
    array_unshift($arguments, $this->login->depot, $this->login->verlader);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return (bool) preg_match(self::RESPONSE_NOTIFY_SUCCESS, $response);
  }

  /**
   * Get the address corresponding to a Dutch postal code.
   *
   * @param string $postcode
   *   The Dutch postal code.
   *
   * @return JPResult\TransMission\types\oAdres
   *   The address corresponsing to the postal code.
   */
  public function getAdresNL($postcode) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return new oAdres((array) $response);
  }

  /**
   * (deprecated) Get the address corresponding to a Dutch postal code.
   *
   * This function seems to be a deprecated variant of getAdresNL(). Use that
   * function instead of this.
   *
   * @param string $postcode
   *   The Dutch postal code.
   *
   * @return JPResult\TransMission\types\oAdres
   *   The address corresponsing to the postal code.
   *
   * @todo Find out if this is deprecated.
   */
  public function getAdresNL_2($postcode) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return $response;
  }

  /**
   * Get available postal code ranges and the depots responsible for them.
   *
   * @return array
   *   An array of available postal code ranges.
   *
   * @see JPResult\TransMission\types\Pkgebied
   */
  public function getPkgebied() {
    // The only argument for this SOAP call is the login object.
    $arguments = array($this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    // Convert array items to Pkgebied objects.
    foreach ($response as $index => $item) {
      $response[$index] = new Pkgebied((array) $item);
    }

    return $response;
  }

  /**
   * Get the status of shipping jobs.
   *
   * This function does not work properly. Use getJobStatus() instead.
   *
   * @param string $datum
   *   (optional) The date of the shipping jobs.
   * @param string $zendingnr
   *   (optional) The unique code of the shipping job.
   * @param string $nrorder
   *   (optional) Indentifier of the order corresponding to the shipping job.
   *
   * @return array
   *   An array of matching shipping jobs and their statuses.
   *
   * @see JPResult\TransMission\types\OpdrachtStatus
   *
   * @todo This function should be deprecated and replaced.
   * @todo Create higher-level function to work around the quirks of this.
   */
  public function getOpdrachtStatus(SoapDate $datum = NULL, $zendingnr = '', $nrorder = '') {
    // Construct the arguments array of the SOAP call.
    $arguments = array($this->login, (string) $datum, $zendingnr, $nrorder);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    // Convert array items to OpdrachtStatus objects.
    foreach ($response as $index => $item) {
      $response[$index] = new OpdrachtStatus((array) $item);
    }

    return $response;
  }

  /**
   * Import a spreadsheet file.
   *
   * @param JPResult\TransMission\types\oBestand
   *   The file to be imported.
   *
   * @return JPResult\TransMission\types\oResult
   *   The result of the request.
   */
  public function uploadFile(oBestand $oBestand) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return new oResult((array) $response);
  }

  /**
   * Get current (unsent) shipping job.
   *
   * @param string $zendingnr
   *   (optional) The unique shipping code. Does not appear to work.
   * @param string $nrorder
   *   (optional) Indentifier of the order corresponding to the shipping job.
   *
   * @return
   *   An instance of JPResult\TransMission\types\oOpdracht containing the
   *   matched shipping job, or FALSE when no match was found.
   *
   * @todo Find out what $zendingnr does.
   */
  public function getAktueleOpdracht($zendingnr = '', $nrorder = '') {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return (array) $response ? new oOpdracht((array) $response) : FALSE;
  }

  /**
   * Get a list of all current (unsent) shipping jobs.
   *
   * @return array
   *   An array of JPResult\TransMission\types\oAktueleOpdracht objects with
   *   basic information about current shipping jobs.
   */
  public function getAktueleOpdrachtLijst() {
    // The only argument for this SOAP call is the login object.
    $arguments = array($this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    // Convert array items to oAktueleOpdracht objects.
    foreach ($response as $index => $item) {
      $response[$index] = new oAktueleOpdracht((array) $item);
    }

    return $response;
  }

  /**
   * Update a shipping job with new shipping job units.
   *
   * @param int $opdrachtid
   *   The ID of the shipping job.
   * @param array $aRegels
   *   An array of JPResult\TransMission\types\Regel objects defining the new
   *   shipping job units.
   *
   * @return
   *   Some inexplicable text.
   *
   * @todo Find out what in the world the return value means.
   */
  public function vernieuwAktueleOpdrachtRegels($opdrachtid, array $aRegels) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return $response;
  }

  /**
   * Set a shipping job as "printed".
   *
   * @param int $opdrachtid
   *   The ID of the shipping job.
   *
   * @return bool
   *   TRUE when successful, FALSE when failed.
   *
   * @todo This function always seems to report success.
   */
  public function updatePrintStatus($opdrachtid) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return (bool) preg_match(self::RESPONSE_PRINTSTATUS_SUCCESS, $response);
  }
}
