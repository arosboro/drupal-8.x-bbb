<?php
/**
 * @file
 * BigBlueButton - Enables universities and colleges to deliver a high-quality
 * learning experience.
 *
 * @author
 * Stefan Auditor <stefan.auditor@erdfisch.de>
 */

/**
 * Administrative settings; Menu callback
 * TODO: Per node type settings?
 */
function bbb_settings() {

  $form = array();
  $form['bbb_server'] = array(
    '#title' => 'Server settings',
    '#type' => 'fieldset',
    '#description' => t('Read more about BigBlueButton on !home. See the documentation for !documentation', array('!home' => l(t('BigBlueButton.org'), 'http://bigbluebutton.org/'), '!documentation' => l(t('installation instructions'), 'http://code.google.com/p/bigbluebutton/'))),
  );
  $form['bbb_server']['bbb_base_url'] = array(
    '#title' => t('Base URL'),
    '#type' => 'textfield',
    '#default_value' => variable_get('bbb_base_url', BIGBLUEBUTTON_BASE_URL),
  );
  $form['bbb_server']['bbb_security_salt'] = array(
    '#title' => t('Security Salt'),
    '#type' => 'textfield',
    '#default_value' => variable_get('bbb_security_salt', BIGBLUEBUTTON_SECURITY_SALT),
    '#description' => t('The predefined security salt. This is a server side configuration option. Please check the BigBlueButton !documentation.', array('!documentation' => l(t('documentation'), 'http://code.google.com/p/bigbluebutton/'))),
  );
  $form['bbb_client'] = array(
    '#title' => t('Client settings'),
    '#type' => 'fieldset',
  );
  $form['bbb_client']['bbb_display_mode'] = array(
    '#title' => t('Block Links'),
    '#type' => 'radios',
    '#options' => array(
      'inline' => t('Display inline'),
      'blank' => t('Open in a new window'),
    ),
    '#default_value' => variable_get('bbb_display_mode', BIGBLUEBUTTON_DISPLAY_MODE),
    '#description' => t('How to open links to meetings from the block provided by the Big Blue Button module.'),
  );
  $form['bbb_client']['bbb_display_height'] = array(
    '#title' => t('Height x Width'),
    '#type' => 'textfield',
    '#default_value' => variable_get('bbb_display_height', BIGBLUEBUTTON_DISPLAY_HEIGHT),
    '#prefix' => '<div class="container-inline">',
    '#suffix' => 'x',
    '#size' => 4,
  );
  $form['bbb_client']['bbb_display_width'] = array(
    '#type' => 'textfield',
    '#default_value' => variable_get('bbb_display_width', BIGBLUEBUTTON_DISPLAY_WIDTH),
    '#suffix' => '</div>',
    '#size' => 4,
    '#description' => '<br />' . t('Give dimensions for inline display, e.g. <em>520px</em> x <em>100%</em>.'),
  );
//  $form['bbb_default'] = array(
//    '#title' => 'Default settings',
//    '#type' => 'fieldset',
//    '#description' => t('You may provide default settings for nodes associated with BigBlueButton.'),
//  );
//  $form['bbb_default']['bbb_default_welcome'] = array(
//    '#title' => t('Welcome message'),
//    '#type' => 'textfield',
//    '#default_value' => variable_get('bbb_default_welcome', ''),
//    '#description' => t('A welcome message that gets displayed on the chat window when the participant joins. You can include keywords (%%CONFNAME%%, %%DIALNUM%%, %%CONFNUM%%) which will be substituted automatically.'),
//  );
//  $form['bbb_default']['bbb_default_dialNumber'] = array(
//    '#title' => t('Dial number'),
//    '#type' => 'textfield',
//    '#default_value' => variable_get('bbb_default_dialNumber', ''),
//    '#description' => t('The dial access number that participants can call in using regular phone.'),
//  );
//  $form['bbb_default']['bbb_default_dialNumber'] = array(
//    '#title' => t('Dial number'),
//    '#type' => 'textfield',
//    '#default_value' => variable_get('bbb_default_dialNumber', ''),
//    '#description' => t('The dial access number that participants can call in using regular phone.'),
//  );
//  $form['bbb_default']['bbb_default_logoutURL'] = array(
//    '#title' => t('Logout URL'),
//    '#type' => 'textfield',
//    '#default_value' => variable_get('bbb_default_logoutURL', ''),
//    '#description' => t('The dial access number that participants can call in using regular phone.'),
//  );
  $form['connection'] = array(
    '#type' => 'submit',
    '#executes_submit_callback' => FALSE,
    '#value' => t('Test Connection'),
  );
    if (bbb_test_connection($form['bbb_server']['bbb_base_url']['#default_value'])) {
      drupal_set_message(t('The connection has been established succesfully. Please save your settings now.'), 'status', FALSE);
    }
    else {
      drupal_set_message(t('The connection could not be established. Please adjust your settings.'), 'error');
    }
  return system_settings_form($form);
}

/**
 * Test conection to Big Blue Button
 */
function bbb_test_connection($url) {
  $response = drupal_http_request($url);
  if ($response->code == 200 || $response->code == 302) {
    return TRUE;
  }
  return FALSE;
}
