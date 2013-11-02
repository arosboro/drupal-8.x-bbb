<?php

/**
 * @file
 * Contains \Drupal\bbb\Form\SettingsForm.
 */

namespace Drupal\bbb\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an administration settings form.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'bbb_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {

    // Get all settings
    $config = $this->configFactory->get('bbb.settings');
    $settings = $config->get();

    $form['bbb_server'] = array(
      '#title' => 'Server settings',
      '#type' => 'fieldset',
      '#description' => t('Read more about BigBlueButton on !home. See the documentation for !documentation', array('!home' => l(t('BigBlueButton.org'), 'http://bigbluebutton.org/'), '!documentation' => l(t('installation instructions'), 'http://code.google.com/p/bigbluebutton/'))),
    );

    $form['bbb_server']['base_url'] = array(
      '#title' => t('Base URL'),
      '#type' => 'textfield',
      '#default_value' => $settings['base_url'],
    );

    $form['bbb_server']['security_salt'] = array(
      '#title' => t('Security Salt'),
      '#type' => 'textfield',
      '#default_value' => $settings['security_salt'],
      '#description' => t('The predefined security salt. This is a server side configuration option. Please check the BigBlueButton !documentation.', array('!documentation' => l(t('documentation'), 'http://code.google.com/p/bigbluebutton/'))),
    );

    $form['bbb_client'] = array(
      '#title' => t('Client settings'),
      '#type' => 'fieldset',
    );

    $form['bbb_client']['display_mode'] = array(
      '#title' => t('Block Links'),
      '#type' => 'radios',
      '#options' => array(
        'inline' => t('Display inline'),
        'blank' => t('Open in a new window'),
      ),
      '#default_value' => $settings['display_mode'],
      '#description' => t('How to open links to meetings from the block provided by the Big Blue Button module.'),
    );
    $form['bbb_client']['display_height'] = array(
      '#title' => t('Height x Width'),
      '#type' => 'textfield',
      '#default_value' => $settings['display_height'],
      '#prefix' => '<div class="container-inline">',
      '#suffix' => 'x',
      '#size' => 4,
    );
    $form['bbb_client']['display_width'] = array(
      '#type' => 'textfield',
      '#default_value' => $settings['display_width'],
      '#suffix' => '</div>',
      '#size' => 4,
      '#description' => '<br />' . t('Give dimensions for inline display, e.g. <em>520px</em> x <em>100%</em>.'),
    );

    $form['connection'] = array(
      '#type' => 'submit',
      '#executes_submit_callback' => FALSE,
      '#value' => t('Test Connection'),
    );

    /*
    if (bbb_test_connection($form['bbb_server']['base_url']['#default_value'])) {
      drupal_set_message(t('The connection has been established succesfully. Please save your settings now.'), 'status', FALSE);
    }
    else {
      drupal_set_message(t('The connection could not be established. Please adjust your settings.'), 'error');
    }
    */

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   * Compares the submitted settings to the defaults and unsets any that are equal. This was we only store overrides.
   */
  public function submitForm(array &$form, array &$form_state) {

    // Get config factory
    $config = $this->configFactory->get('bbb.settings');

    $form_values = $form_state['values'];

    $config
        ->set('security_salt', $form_values['bbb_server']['security_salt'])
        ->set('base_url', $form_values['bbb_server']['base_url'])
        ->set('display_mode', $form_values['bbb_client']['display_mode'])
        ->set('display_height', $form_values['bbb_client']['display_height'])
        ->set('display_width', $form_values['bbb_client']['display_width'])
        ->save();

    parent::submitForm($form, $form_state);

  }
}