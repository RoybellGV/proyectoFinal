<?php

namespace Drupal\text_generator\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a Text generator block with which you can generate dummy text anywhere.
 *
 * @Block(
 *   id = "text_generator_test_block",
 *   admin_label = @Translation("Your location"),
 * )
 */
class TextGeneratorTestBlock extends BlockBase {
  // Needs to implement build(), blockAccess(), blockForm(), and blockSubmit()

  /**
   * {@inheritdoc}
   */
public function build() {

$form['page_title'] = [
'#type' => 'textfield',
'#title' => $this -> t('Ingrese el nombre del lugar ubicar'),
];

$form['submit'] = array(
'#type' => 'submit',
'#value' => $this->t('Ubicar'),
);

$form['#attached']['library'][] = 'text_generator/text_generator';

return $form;
}

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    // Deal with access
    return AccessResult::allowedIfHasPermission($account, 'text_generator');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('text_generator_test_block_settings', $form_state->getValue('text_generator_test_block_settings'));
  }
}
