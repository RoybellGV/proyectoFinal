<?php

namespace Drupal\text_generator\Form;

use Drupal\Core\Form\ConfigFormBase;

use Drupal\Core\Form\FormStateInterface;

class TextGeneratorForm extends ConfigFormBase {
  public function getFormId(){
    return 'text_generator_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $form = parent::buildForm($form, $form_state);

    $config = $this -> config ('text_generator.settings');

    $form['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this -> t('Ingrese el nombre del lugar ubicar'),
    ];

    $form['actions']['submit'] = [
    '#type' => 'button',
    '#value' => $this->t('Visit Us'),
    '#button_type' => 'primary',
    '#attributes' => ['enabled' => 'enabled',
                      'onclick' => "window.open('/our-location/');"],
];

    return $form;
  }



   /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('text_generator_test_block_settings', $form_state->getValue('text_generator_test_block_settings'));
  }

  protected function getEditableConfigNames(){
    return [
      'text_generator.settings',
    ];
  }

}



