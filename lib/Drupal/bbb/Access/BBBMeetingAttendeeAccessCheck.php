<?php
/**
 * Created by PhpStorm.
 * User: arosboro
 * Date: 11/4/13
 * Time: 1:12 PM
 */

namespace Drupal\bbb\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class BBBMeetingAttendeeAccessCheck implements AccessCheckInterface {
  /**
   * A user account to check access for.
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

  /**
   * Constructs a BBBMeetingAttendeeAccessCheck object.
   *
   * @param \Drupal\Core\Session\AccountInterface
   *   The user account to check access for.
   */
  public function __construct(AccountInterface $account) {
    $this->account = $account;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(Route $route) {
    return array_key_exists('_bbb_meeting_attendee_access_check', $route->getRequirements());
  }

  /**
   * {@inheritdoc}
   */
  public function access(Route $route, Request $request, AccountInterface $account, $node) {
    if (is_numeric($node)) {
      $node = node_load($node);
    }

    if (!bbb_is_meeting_type($node->getType())) {
      return self::KILL;
    }

    // Check for access to attend meetings
    if ($this->account->hasPermission('attend meetings') || $this->account->hasPermission('administer big blue button')) {
      return self::ALLOW;
    }
    return self::DENY;
  }
} 
