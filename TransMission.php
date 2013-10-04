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

use JPResult\TransMission\types\oLogin;
use JPResult\TransMission\types\oOpdracht;
use JPResult\TransMission\types\oTransport;

/**
 * Supplies an API to communicate with TransMission's SOAP service.
 */
class TransMission extends \SoapClient {

  /**
   * The URL of the SOAP service of TransMission's production environment.
   */
  const DEFAULT_WSDL = 'https://portal.trans-mission.nl/webservices/TMSOnline.wsdl';

  /**
   * The date format used by TransMission's SOAP service.
   */
  const DATE_FORMAT = 'Y-m-d';

  /**
   * The timezone used by TransMission's SOAP service.
   */
  const DEFAULT_TIMEZONE = 'Europe/Amsterdam';

  /**
   * The regex pattern to check if delOpdracht() was successful.
   */
  const RESPONSE_REMOVE_SUCCESS = '/^Opdracht \w+ verwijderd$/';

  /**
   * The login object, used for authentication.
   */
  public $login;

  /**
   * Constructs a TransMission object.
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
   * Creates a shipping job in TransMission.
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
   * Removes a job in TransMission.
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
   * Returns a PDF file with the list of unsent shipping jobs.
   */
  public function getVerzendlijst() {
    // The only argument for this SOAP call is the login object.
    $arguments = array($this->login);

    $response = $this->soapCall(__FUNCTION__, $arguments);

    return base64_decode($response);
  }

  /**
   * @todo
   */
  public function getLabels(ArrayOfString $aNrzend) {
  }

  /**
   * @todo
   */
  public function sendOpdrachten() {
  }

  /**
   * @todo
   */
  public function getDefinities() {
  }

  /**
   * @todo
   */
  public function getStatus(date $datum) {
  }

  /**
   * @todo
   */
  public function getETA(date $datum) {
  }

  /**
   * @todo
   */
  public function addVooraanmelding($depot, $verlader, oVooraanmelding $oVooraanmelding) {
  }

  /**
   * @todo
   */
  public function getAdresNL($postcode) {
  }

  /**
   * @todo
   */
  public function getAdresNL_2($postcode) {
  }

  /**
   * @todo
   */
  public function getPkgebied() {
  }

  /**
   * @todo
   */
  public function getOpdrachtStatus($datum, $zendingnr, $nrorder) {
  }

  /**
   * @todo
   */
  public function uploadFile(oBestand $oBestand) {
  }

  /**
   * @todo
   */
  public function getAktueleOpdracht($zendingnr, $nrorder) {
  }

  /**
   * @todo
   */
  public function getAktueleOpdrachtLijst() {
  }

  /**
   * @todo
   */
  public function vernieuwAktueleOpdrachtRegels($opdrachtid, array $aRegels) {
  }

  /**
   * @todo
   */
  public function updatePrintStatus($opdrachtid) {
  }
}
