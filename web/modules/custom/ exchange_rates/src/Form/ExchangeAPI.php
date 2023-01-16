<?php

namespace Drupal\exchange_rates\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class ExchangeAPI extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'exchange_rates.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'exchange_rates_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['disabled_api'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disabled api'),
      '#default_value' => $config->get('disabled_api'),
    ];

    $form['api_base_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Api base url'),
      '#default_value' => $config->get('api_base_url'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config(static::SETTINGS)
      ->set('api_base_url', $form_state->getValue('api_base_url'))
      ->set('disabled_api', $form_state->getValue('disabled_api'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
