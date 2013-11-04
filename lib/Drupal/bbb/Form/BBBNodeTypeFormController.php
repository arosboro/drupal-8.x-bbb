<?php

/**
 * @file
 * Contains \Drupal\bbb\Form\BBBNodeTypeFormController.
 */

namespace Drupal\bbb\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityFormController;

/**
 * Provides an administration settings form.
 */
class BBBNodeTypeFormController extends EntityFormController {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'bbb_content_type';
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, array &$form_state) {
    $form = parent::form($form, $form_state);
    $bbbNodeType = $this->entity;

    $form['bbb'] = array(
      '#title' => t('Big Blue Button settings'),
      '#type' => 'details',
      '#tree' => TRUE,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#group' => 'additional_settings',
      '#weight' => 1,
    );

    $form['bbb']['active'] = array(
      '#type' => 'checkbox',
      '#title' => t('Treat this node type as meeting'),
      '#default_value' => $bbbNodeType->active(),
      '#weight' => 0,
    );

    $form['bbb']['showLinks'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show links to attend, moderate or terminate a meeting beneath the node'),
      '#default_value' => $bbbNodeType->showLinks(),
      '#weight' => 1,
    );

    $form['bbb']['showStatus'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display meeting status on node'),
      '#default_value' => $bbbNodeType->showStatus(),
      '#weight' => 2,
    );

    $form['bbb']['moderatorRequired'] = array(
      '#type' => 'checkbox',
      '#title' => t('Require a moderator present to run the meeting.'),
      '#default_value' => $bbbNodeType->moderatorRequired(),
      '#weight' => 3,
    );

    $form['bbb']['welcome'] = array(
      '#title' => t('Welcome message'),
      '#type' => 'textfield',
      '#default_value' => $bbbNodeType->welcome(),
      '#maxlength' => 255,
      '#description' => t('A welcome message that gets displayed on the chat window when the participant joins. You can include keywords (%%CONFNAME%%, %%DIALNUM%%, %%CONFNUM%%) which will be substituted automatically.'),
      '#weight' => 5,
    );

    $form['bbb']['dialNumber'] = array(
      '#title' => t('Dial number'),
      '#type' => 'textfield',
      '#default_value' => $bbbNodeType->dialNumber(),
      '#maxlength' => 32,
      '#description' => t('The dial access number that participants can call in using regular phone.'),
      '#weight' => 6,
    );

    $form['bbb']['moderatorPW'] = array(
      '#title' => t('Moderator password'),
      '#type' => 'textfield',
      '#default_value' => $bbbNodeType->moderatorPW(),
      '#maxlength' => 32,
      '#description' => t('The password that will be required for moderators to join the meeting or for certain administrative actions (i.e. ending a meeting).'),
      '#weight' => 7,
    );

    $form['bbb']['attendeePW'] = array(
      '#title' => t('Attendee password'),
      '#type' => 'textfield',
      '#default_value' => $bbbNodeType->attendeePW(),
      '#maxlength' => 32,
      '#description' => t('The password that will be required for attendees to join the meeting.'),
      '#weight' => 8,
    );

    $form['bbb']['logoutURL'] = array(
      '#title' => t('Logout URL'),
      '#type' => 'textfield',
      '#default_value' => $bbbNodeType->logoutURL(),
      '#maxlength' => 255,
      '#description' => t('The URL that the Big Blue Button client will go to after users click the OK button on the <em>You have been logged out message</em>.'),
      '#weight' => 9,
    );

    if (user_access('record meetings')) {
      $form['bbb']['record'] = array(
        '#title' => t('Record new meetings of this type, by default.'),
        '#type' => 'checkbox',
        '#default_value' => $bbbNodeType->record(),
        '#description' => 'Meetings that are recorded can be viewed at <strong>http://example.com/playback/slides/playback.html?meetingId=<meetingId></strong> (The meeting ID is about 54 characters long.)',
        '#weight' => 4,
      );
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validate(array $form, array &$form_state) {
    $input = $form_state['input']['bbb'];
    $values = &$form_state['values']['bbb'];

    foreach ($input as $key => $value) {
      $values[$key] = check_plain($value);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, array &$form_state) {
    $bbbNodeType = $this->entity;
    $values = $form_state['values']['bbb'];
    $bbbNodeType->setActive($values['active']);
    $bbbNodeType->setShowLinks($values['showLinks']);
    $bbbNodeType->setShowStatus($values['showStatus']);
    $bbbNodeType->setModeratorRequired($values['moderatorRequired']);
    $bbbNodeType->setWelcome($values['welcome']);
    $bbbNodeType->setDialNumber($values['dialNumber']);
    $bbbNodeType->setModeratorPW($values['moderatorPW']);
    $bbbNodeType->setAttendeePW($values['attendeePW']);
    $bbbNodeType->setLogoutURL($values['logoutURL']);
    $bbbNodeType->setRecord($values['record']);
    $status = $bbbNodeType->save();
  }
}
