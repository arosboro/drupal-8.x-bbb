<?php
/**
 * @file
 * Contains Drupal\bbb\Plugin\Core\Entity\BBBContentType.
 */

namespace Drupal\bbb\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\bbb\BBBContentTypeInterface;

/**
 * Defines the BBBContentType entity.
 *
 *  @Plugin(
 *    id = "bbb_content_type",
 *    label = @Translation("Big Blue Button Content Type"),
 *    module = "bbb",
 *    controllers = {
 *      "form" = {
 *        "edit" = "Drupal\bbb\Form\BBBContentTypeFormController"
 *      }
 *    },
 *    config_prefix = "bbb.content_type",
 *    admin_permission = "administer big blue button"
 *    entity_keys = {
 *      "id" = "id"
 *      "label" = "label"
 *      "uuid" = "uuid"
 *   }
 * )
 */
class BBBContentType extends ConfigEntityBase implements BBBContentTypeInterface {
  public $id;
  public $uuid;
  public $label;

  private $active;
  private $showLinks;
  private $showStatus;
  private $moderatorRequired;
  private $welcome;
  private $dialNumber;
  private $moderatorPW;
  private $attendeePW;
  private $logoutURL;
  private $record;

  public function active() {
    return $this->active;
  }

  public function setActive($value) {
    $this->active = $value;
  }

  public function showLinks() {
    return $this->showLinks;
  }

  public function setShowLinks($value) {
    $this->showLinks = $value;
  }

  public function showStatus() {
    return $this->showStatus;
  }

  public function setShowStatus($value) {
    $this->showStatus = $value;
  }

  public function moderatorRequired() {
    return $this->moderatorRequired;
  }

  public function setModeratorRequired($value) {
    $this->moderatorRequired = $value;
  }

  public function welcome() {
    return $this->welcome;
  }

  public function setWelcome($value) {
    $this->welcome = $value;
  }

  public function dialNumber() {
    return $this->dialNumber;
  }

  public function setDialNumber($value) {
    $this->dialNumber = $value;
  }

  public function moderatorPW() {
    return $this->moderatorPW;
  }

  public function setModeratorPW($value) {
    $this->moderatorPW = $value;
  }

  public function attendeePW() {
    return $this->attendeePW;
  }

  public function setAttendeePW($value) {
    $this->attendePW = $value;
  }

  public function logoutURL() {
    return $this->logoutURL;
  }

  public function setLogoutURL($value) {
    $this->logoutURL = $value;
  }

  public function record() {
    return $this->record();
  }

  public function setRecord($value) {
    $this->record = $value;
  }

}