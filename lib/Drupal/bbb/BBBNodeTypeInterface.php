<?php
/**
 * @file
 * Contains \Drupal\bbb\BBBNodeTypeInterface.
 */

namespace Drupal\bbb;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining a Foo Bar entity.
 */
interface BBBNodeTypeInterface extends ConfigEntityInterface {

  public function active();

  public function setActive($value);

  public function showLinks();

  public function setShowLinks($value);

  public function showStatus();

  public function setShowStatus($value);

  public function moderatorRequired();

  public function setModeratorRequired($value);

  public function welcome();

  public function setWelcome($value);

  public function dialNumber();

  public function setDialNumber($value);

  public function moderatorPW();

  public function setModeratorPW($value);

  public function attendeePW();

  public function setAttendeePW($value);

  public function logoutURL();

  public function setLogoutURL($value);

  public function record();

  public function setRecord($value);

}
