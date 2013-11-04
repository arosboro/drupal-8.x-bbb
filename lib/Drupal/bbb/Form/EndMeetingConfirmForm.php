<?php

/**
 * @file
 * Contains \Drupal\bbb\Form\EndMeetingConfirmForm.
 */

namespace Drupal\bbb\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an administration settings form.
 */
class EndMeetingConfirmForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'bbb_end_meeting_confirm_form';
  }

  /**
   * {@inheritdoc}
   * Terminate confirm form
   */
  public function buildForm(array $form, array &$form_state) {
    $node = node_load(arg(1));
    $form = confirm_form(
      array(
        'nid' => array(
          '#type' => 'value',
          '#value' => $node->id(),
        ),
      ),
      t('Are you sure you want to terminate the meeting !name?', array('!name' => l($node->getTitle())),
        'node/' . $node->id()),
      t('This action cannot be undone, all attendes will be removed from the meeting.'),
      t('Terminate'),
      t('Cancel')
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    $node = node_load($form_state['values']['nid']);
    $request = bbb_meeting_end($node);

    if ($request === FALSE) {
      drupal_set_message(t('There was an error terminating the meeting.'), 'error');
    } else {
      drupal_set_message(t('The meeting has been terminated.'));
    }
    return new RedirectResponse(url('node/' . $node->id(), array('absolute' => TRUE)));
  }
}