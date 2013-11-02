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
 *   controller_class = "Drupal\bbb\BBBContentTypeStorageController",
 *   list_controller_class = "Drupal\bbb\BBBContentTypeListController",
 *   form_controller_class = {
 *     "default" = "Drupal\bbb\BBBContentTypeFormController"
 *   },
 *   uri_callback = "bbb_content_type_uri",
 *   config_prefix = "bbb.content_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   }
 * )
 */
class BBBContentType extends ConfigEntityBase {
  public $node_type;
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