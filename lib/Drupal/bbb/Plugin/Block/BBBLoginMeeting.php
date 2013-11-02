<?php
/**
 * @file
 * Contains \Drupal\user\Plugin\Block\BBBLoginMeeting.
 */
namespace Drupal\bbb\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\block\Annotation\Block;
use Drupal\Core\Annotation\Translation;

/**
 * Provides a "BBB Meeting details" block.
 *
 * @Block(
 *   id = "bbb_login_meeting",
 *   admin_label = @Translation("BBB Meeting Details")
 * )
 */
class BBBLoginMeeting extends BlockBase {
  /**
   * Overrides \Drupal\block\BlockBase::defaultConfiguration().
   */
  public function defaultConfiguration() {}

  /**
   * Overrides \Drupal\block\BlockBase::blockForm().
   */
  public function blockForm($form, &$form_state) {
    $form = array();
    return $form;
  }
  /**
   * Overrides \Drupal\block\BlockBase::blockSubmit().
   */
  public function blockSubmit($form, &$form_state) {}

  /**
   * Implements \Drupal\block\BlockBase::build().
   */
  public function build() {
    $meeting = bbb_get_meeting(arg(1));
    $meeting['#theme'] = 'bbb_theme';
    return $meeting;
  }
}