<?php

/**
 * @file
 * Contains \Drupal\bbb\Form\BBBContentTypeForm.
 */

namespace Drupal\bbb\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityFormController;

/**
 * Provides an administration settings form.
 */
class BBBContentTypeFormController extends EntityFormController {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'bbb_content_type';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $form = parent::form($form, $form_state);
    $bbbContentType = $this->entity;

    $form['bbb'] = array(
      '#title' => t('Big Blue Button settings'),
      '#type' => 'fieldset',
      '#tree' => TRUE,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      '#group' => 'additional_settings',
    );

    $form['bbb']['active'] = array(
      '#type' => 'checkbox',
      '#title' => t('Treat this node type as meeting'),
      '#default_value' => $bbbContentType->active(),
    );

    $form['bbb']['show_links'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show links to attend, moderate or terminate a meeting beneath the node'),
      '#default_value' => $bbbContentType->show_links(),
    );

    $form['bbb']['show_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display meeting status on node'),
      '#default_value' => $bbbContentType->show_status(),
    );

    $form['bbb']['moderator_required'] = array(
      '#type' => 'checkbox',
      '#title' => t('Require a moderator present to run the meeting.'),
      '#default_value' => $bbbContentType->moderator_required(),
    );

    $form['bbb']['welcome'] = array(
      '#title' => t('Welcome message'),
      '#type' => 'textfield',
      '#default_value' => $bbbContentType->welcome(),
      '#maxlength' => 255,
      '#description' => t('A welcome message that gets displayed on the chat window when the participant joins. You can include keywords (%%CONFNAME%%, %%DIALNUM%%, %%CONFNUM%%) which will be substituted automatically.'),
    );

    $form['bbb']['dialNumber'] = array(
      '#title' => t('Dial number'),
      '#type' => 'textfield',
      '#default_value' => $bbbContentType->dialNumber(),
      '#maxlength' => 32,
      '#description' => t('The dial access number that participants can call in using regular phone.'),
    );

    $form['bbb']['moderatorPW'] = array(
      '#title' => t('Moderator password'),
      '#type' => 'textfield',
      '#default_value' => $bbbContentType->moderatorPW(),
      '#maxlength' => 32,
      '#description' => t('The password that will be required for moderators to join the meeting or for certain administrative actions (i.e. ending a meeting).'),
    );

    $form['bbb']['attendeePW'] = array(
      '#title' => t('Attendee password'),
      '#type' => 'textfield',
      '#default_value' => $bbbContentType->attendeePW(),
      '#maxlength' => 32,
      '#description' => t('The password that will be required for attendees to join the meeting.'),
    );

    $form['bbb']['logoutURL'] = array(
      '#title' => t('Logout URL'),
      '#type' => 'textfield',
      '#default_value' => $bbbContentType->logoutURL(),
      '#maxlength' => 255,
      '#description' => t('The URL that the Big Blue Button client will go to after users click the OK button on the <em>You have been logged out message</em>.'),
    );

    if (user_access('record meetings')) {
      $form['bbb']['record'] = array(
        '#title' => t('Record new meetings of this type, by default.'),
        '#type' => 'checkbox',
        '#default_value' => $bbbContentType->record(),
        '#description' => 'Meetings that are recorded can be viewed at <strong>http://example.com/playback/slides/playback.html?meetingId=<meetingId></strong> (The meeting ID is about 54 characters long.)',
        '#weight' => -1,
      );
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, array &$form_state) {

    $bbbContentType = $this->entity;
    $bbbContentType->save();
    dpm($bbbContentType, 'BBBContentType');
  }
}