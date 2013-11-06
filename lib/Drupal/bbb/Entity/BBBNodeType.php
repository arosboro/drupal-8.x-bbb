<?php
/**
 * @file
 * Contains Drupal\bbb\Plugin\Core\Entity\BBBNodeType.
 */

namespace Drupal\bbb\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\bbb\BBBNodeTypeInterface;

/**
 * Defines the BBBNodeType entity.
 *
 *  @EntityType(
 *    id = "bbb_node_type",
 *    label = @Translation("Big Blue Button Content Type"),
 *    module = "bbb",
 *    controllers = {
 *      "storage" = "Drupal\Core\Config\Entity\ConfigStorageController",
 *      "list" = "Drupal\bbb\Controller\BBBNodeTypeListController",
 *      "form" = {
 *        "add" = "Drupal\bbb\Form\BBBNodeTypeFormController",
 *        "edit" = "Drupal\bbb\Form\BBBNodeTypeFormController",
 *        "delete" = "Drupal\bbb\Form\BBBNodeTypeDeleteForm"
 *      }
 *    },
 *    config_prefix = "bbb.node_type",
 *    admin_permission = "administer big blue button",
 *    entity_keys = {
 *      "id" = "id",
 *      "label" = "label",
 *      "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "admin/structure/bigbluebutton/{bbb_node_type}"
 *   }
 * )
 */
class BBBNodeType extends ConfigEntityBase implements BBBNodeTypeInterface {
  public $id;
  public $uuid;
  public $label;
  public $active;
  public $showLinks;
  public $showStatus;
  public $moderatorRequired;
  public $welcome;
  public $dialNumber;
  public $moderatorPW;
  public $attendeePW;
  public $logoutURL;
  public $record;

  public function setId($value) {
    $BBBNodeType = entity_load('bbb_node_type', $value);
    if (empty($config)) {
      $this->id = $value;
      return TRUE;
    }
    return FALSE;
  }

  public function setLabel($value) {
    $this->label = $value;
  }

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
    $this->attendeePW = $value;
  }

  public function logoutURL() {
    return $this->logoutURL;
  }

  public function setLogoutURL($value) {
    $this->logoutURL = $value;
  }

  public function record() {
    return $this->record;
  }

  public function setRecord($value) {
    $this->record = $value;
  }

}
