<?php

namespace Drupal\exchange_rates\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
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
   * @var \Drupal\exchange_rates\ExchangeAPIConnector
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
    $url = $form_state->getValue('api_base_url');
    $data = $this->exchangeApiService->getCurrencyName($url);

    $form['disabled_api'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disabled api'),
      '#default_value' => $config->get('disabled_api'),
    ];

    $form['api_base_url'] = [
      '#name' => 'api_base_url',
      '#type' => 'textfield',
      '#title' => $this->t('Api base url'),
      '#default_value' => $config->get('api_base_url'),
      '#ajax' => [
        'callback' => '::checkInputUrl',
        'event' => 'change',
      ],
    ];

    $form['check_url'] = [
      '#type' => 'button',
      '#value' => $this->t('Check URL'),
      '#ajax' => [
        'callback' => '::checkURL',
        'event' => 'click',
      ],

    ];

    $form['get_currency'] = [
      '#type' => 'button',
      "#name" => 'get',
      '#value' => $this->t('Get currency'),
      '#ajax' => [
        'callback' => '::getCurrency',
        'event' => 'click',
        'wrapper' => 'list-course',
      ],
    ];

    $form['list_courses_wrap'] = [
      '#type' => 'details',
      '#title' => $this->t('Exchange rates list'),
      '#description' => $this->t('The listed configuration will be updated.'),
      '#open' => TRUE,
      '#attributes' => [
        'id' => 'list-course',
      ],
    ];

    $form['list_courses_wrap']['list_course'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Exchange Rate'),
      '#default_value' => $data == [] ? [] : $config->get('list_course'),
      '#options' => $data,
    ];

    $form['count_days'] = [
      '#type' => 'number',
      '#title' => t('Last days period'),
      '#default_value' => $config->get('count_days') ?: 1,
      '#min' => 1,
      '#max' => 34,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * Rerender courses list.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state.
   *
   * @return mixed
   *   Return courses list.
   */
  public function getCurrency(array &$form, FormStateInterface $form_state) {
    return $form['list_courses_wrap'];
  }

  /**
   * Check api url.
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   */
  public function checkURL(array &$form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    if ($this->exchangeApiService->checkRequest($form_state->getValue('api_base_url'))) {
      $data = $this->exchangeApiService->sendRequest(1, $form_state->getValue('api_base_url'));
      $ajax_response->addCommand(new MessageCommand(json_encode($data)));
    }
    else {
      $ajax_response->addCommand(new MessageCommand('Url is not valid !', NULL, ['type' => 'error']));
    }
    return $ajax_response;
  }

  /**
   * Validate input url.
   *
   * @param array $form
   *   Form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Form state.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   Return errors.
   */
  public function checkInputUrl(array &$form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    $config = $this->config(static::SETTINGS);
    if ($this->exchangeApiService->checkRequest($form_state->getValue('api_base_url'))) {
      $ajax_response->addCommand(new MessageCommand('Url is valid !'));
    }
    else {
      $ajax_response->addCommand(new MessageCommand('Url is not valid !', NULL, ['type' => 'error']));
    }
    return $ajax_response;
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
      ->set('count_days', $form_state->getValue('count_days'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
