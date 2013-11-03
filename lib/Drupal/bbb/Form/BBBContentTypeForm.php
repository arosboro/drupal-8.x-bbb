<?php

/**
 * @file
 * Contains \Drupal\bbb\Form\BBBContentTypeForm.
 */

namespace Drupal\bbb\Form;

use Drupal\Core\Entity\EntityFormController;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an administration settings form.
 */
class BBBContentTypeForm extends EntityFormController {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    dpm('hello');
    return 'bbb_content_type';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    // Get all settings
    $config = $this->configFactory->get('bbb.content_type');
    $settings = $config->get();

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
      '#default_value' => $settings['active'],
    );

    $form['bbb']['show_links'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show links to attend, moderate or terminate a meeting beneath the node'),
      '#default_value' => $settings['show_links'],
    );

    $form['bbb']['show_status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display meeting status on node'),
      '#default_value' => $settings['show_status'],
    );

    $form['bbb']['moderator_required'] = array(
      '#type' => 'checkbox',
      '#title' => t('Require a moderator present to run the meeting.'),
      '#default_value' => $settings['moderator_required'],
    );

    $form['bbb']['welcome'] = array(
      '#title' => t('Welcome message'),
      '#type' => 'textfield',
      '#default_value' => $settings['welcome'],
      '#maxlength' => 255,
      '#description' => t('A welcome message that gets displayed on the chat window when the participant joins. You can include keywords (%%CONFNAME%%, %%DIALNUM%%, %%CONFNUM%%) which will be substituted automatically.'),
    );

    $form['bbb']['dialNumber'] = array(
      '#title' => t('Dial number'),
      '#type' => 'textfield',
      '#default_value' => $settings['dialNumber'],
      '#maxlength' => 32,
      '#description' => t('The dial access number that participants can call in using regular phone.'),
    );

    $form['bbb']['moderatorPW'] = array(
      '#title' => t('Moderator password'),
      '#type' => 'textfield',
      '#default_value' => $settings['moderatorPW'],
      '#maxlength' => 32,
      '#description' => t('The password that will be required for moderators to join the meeting or for certain administrative actions (i.e. ending a meeting).'),
    );

    $form['bbb']['attendeePW'] = array(
      '#title' => t('Attendee password'),
      '#type' => 'textfield',
      '#default_value' => $settings['attendeePW'],
      '#maxlength' => 32,
      '#description' => t('The password that will be required for attendees to join the meeting.'),
    );

    $form['bbb']['logoutURL'] = array(
      '#title' => t('Logout URL'),
      '#type' => 'textfield',
      '#default_value' => $settings['logoutURL'],
      '#maxlength' => 255,
      '#description' => t('The URL that the Big Blue Button client will go to after users click the OK button on the <em>You have been logged out message</em>.'),
    );

    if (user_access('record meetings')) {
      $form['bbb']['record'] = array(
        '#title' => t('Record new meetings of this type, by default.'),
        '#type' => 'checkbox',
        '#default_value' => $settings['record'],
        '#description' => 'Meetings that are recorded can be viewed at <strong>http://example.com/playback/slides/playback.html?meetingId=<meetingId></strong> (The meeting ID is about 54 characters long.)',
        '#weight' => -1,
      );
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, array &$form_state) {

    $bbbContentType = $this->getEntity($form_state);
    $bbbContentType->save();
    dpm($bbbContentType, 'BBBContentType');

    parent::save($form, $form_state);

    /*
    $form_values = $form_state['values']['bbb'];

    $config
        ->set('active', $form_values['active'])
        ->set('show_links', $form_values['show_links'])
        ->set('show_status', $form_values['show_status'])
        ->set('moderator_required', $form_values['moderator_required'])
        ->set('welcome', $form_values['welcome'])
        ->set('dialNumber', $form_values['dialNumber'])
        ->set('moderatorPW', $form_values['moderatorPW'])
        ->set('attendeePW', $form_values['attendeePW'])
        ->set('logoutURL', $form_values['logoutURL'])
        ->set('record', $form_values['record'])
        ->save();

    parent::submitForm($form, $form_state);
    */
  }
}