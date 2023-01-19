<?php

namespace Drupal\exchange_rates\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\exchange_rates\ExchangeAPIConnector;
use Psr\Container\ContainerInterface;

/**
 * Configure example settings for this site.
 */
class ExchangeAPI extends ConfigFormBase {

  /**
   * All methods on service.
   *
   * @var ExchangeAPIConnector $exchangeApiService
   */
  protected $exchangeApiService;

  /**
   * Class constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory, ExchangeAPIConnector $exchangeApiService) {
    parent::__construct($config_factory);
    $this->exchangeApiService = $exchangeApiService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('exchange_rates.api_connector')
    );
  }

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
    $data = $this->exchangeApiService->getCurrencyName();

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

    $form['list_course'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Exchange Rate'),
      '#default_value' => $config->get('list_course') ?? [],
      '#options' => $data,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state->getValue('api_base_url') == '')) {
      $form_state->setErrorByName('api_base_url', $this->t('Url is required'));
    }
    if (!$this->exchangeApiService->checkRequest($form_state->getValue('api_base_url'))) {
      $form_state->setErrorByName('api_base_url', $this->t('Url is not valid'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config(static::SETTINGS)
      ->set('api_base_url', $form_state->getValue('api_base_url'))
      ->set('disabled_api', $form_state->getValue('disabled_api'))
      ->set('list_course', $form_state->getValue('list_course'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
