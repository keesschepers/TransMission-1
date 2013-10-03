<?php

/**
 * @file
 * Contains the oLogin data type used by TransMission.
 */

namespace JPResult\TransMission\types;

include_once 'BaseType.php';

/**
 * Defines the oLogin data type used for authentication.
 */
class oLogin extends BaseType {
  /**
   * The username of the account.
   */
  public $username;

  /**
   * The password of the account.
   */
  public $password;

  /**
   * The ID of the depot the account is registered at.
   */
  public $depot;

  /**
   * The client ID corresponding to the account.
   */
  public $verlader;
}
