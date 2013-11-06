<?php

/**
 * @file
 * Contains \Drupal\bbb\Form\BBBNodeTypeDeleteForm.
 */

namespace Drupal\bbb\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;

/**
 * Provides an administration settings form.
 */
class BBBNodeTypeDeleteForm extends EntityConfirmFormBase {
  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to remove the BigBlueButton settings for %name?', array('%name' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelRoute() {
    return array(
      'route_name' => 'bbb.node_type.list',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array $form, array &$form_state) {
    $this->entity->delete();
    drupal_set_message($this->t('Category %label has been deleted.', array('%label' => $this->entity->label())));
    $form_state['redirect'] = 'admin/structure/bigbluebutton';
  }
}
