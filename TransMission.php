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
   * Creates a job in TransMission.
   *
   * @param JPResult\TransMission\types\oOpdracht $oOpdracht
   *   The object describing the job to be created in TransMission.
   *
   * @return JPResult\TransMission\types\oTransport
   *   The transport object.
   */
  public function addOpdracht(oOpdracht $oOpdracht) {
    $arguments = func_get_args();

    // Prepend the login details to the list of arguments.
    array_unshift($arguments, $this->login);

    return new oTransport((array) $this->soapCall(__FUNCTION__, $arguments));
  }

  /**
   * @todo
   */
  public function delOpdracht(string $nrzend) {
  }

  /**
   * @todo
   */
  public function getVerzendlijst() {
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
  public function addVooraanmelding(string $depot, string $verlader, oVooraanmelding $oVooraanmelding) {
  }

  /**
   * @todo
   */
  public function getAdresNL(string $postcode) {
  }

  /**
   * @todo
   */
  public function getAdresNL_2(string $postcode) {
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
  public function getAktueleOpdracht(string $zendingnr, string $nrorder) {
  }

  /**
   * @todo
   */
  public function getAktueleOpdrachtLijst() {
  }

  /**
   * @todo
   */
  public function vernieuwAktueleOpdrachtRegels(string $opdrachtid, array $aRegels) {
  }

  /**
   * @todo
   */
  public function updatePrintStatus(string $opdrachtid) {
  }
}
