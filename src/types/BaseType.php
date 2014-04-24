<?php

/**
 * @file
 * Contains the abstract BaseType class used by TransMission.
 */

namespace JPResult\TransMission\types;

/**
 * Abstract class used to define classes matching TransMission's data types.
 */
abstract class BaseType {
  /**
   * Create an instance of the child class.
   *
   * This function iterates over the child class' default properties and sets
   * their values based on the parameter passed to the function.
   *
   * @param array $data
   *   (optional) An associative array defining the values to set on the new
   *   object's properties. The value of each property of the class is set to
   *   the value of the array item by the same name.
   */
  function __construct(array $data = array()) {
    foreach (get_object_vars($this) as $property => $value) {
      $this->{$property} = isset($data[$property]) ? $data[$property] : $value;
    }
  }
}
