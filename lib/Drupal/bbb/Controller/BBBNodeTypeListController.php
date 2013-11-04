<?php
/**
 * @file
 * Contains \Drupal\bbb\Controller\BBBNodeTypeListController.
 */
namespace Drupal\bbb\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListController;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Foo Bar.
 */
class BBBNodeTypeListController extends ConfigEntityListController {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('BBB Content Type');
    $header['id'] = $this->t('Machine name');
    return $header + parent::buildHeader();
  }
  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $this->getLabel($entity);
    $row['id'] = $entity->id();
    return $row + parent::buildRow($entity);
  }
}
