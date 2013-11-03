<?php
/**
 * @file
 * Contains Drupal\bbb\Plugin\Core\Entity\BBBContentType.
 */

namespace Drupal\bbb\Plugin\Core\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;

/**
 * Defines the BBBContentType entity.
 *
 * @Plugin(
 *   id = "BBBContentType",
 *   label = @Translation("Big Blue Button Content Type"),
 *   module = "bbb",
 *   form_controller_class = {
 *     "default" = "Drupal\bbb\Form\BBBContentTypeFormController"
 *   },
 *   config_prefix = "bbb.content_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   }
 * )
 */
class BBBContentType extends ConfigEntityBase {
  public $active;
  public $show_links;
  public $show_status;
  public $moderator_required;
  public $welcome;
  public $dialNumber;
  public $moderatorPW;
  public $attendeePW;
  public $logoutURL;
  public $record;
}