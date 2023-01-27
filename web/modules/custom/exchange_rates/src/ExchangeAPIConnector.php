<?php

namespace Drupal\exchange_rates;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use GuzzleHttp\ClientInterface;

/**
 * Exchange rates service.
 */
class ExchangeAPIConnector {

  /**
   * This variable send http request.
   *
   * @var object
   */
  private $httpClient;

  /**
   * This variable get config form seating.
   *
   * @var object
   */
  private $configForm;

  /**
   * Error log.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  private $errorLog;

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface|\Drupal\exchange_rates\ExchangeRatesEntityService
   */
  private $entityService;

  /**
   * Constructs an ExchangeAPIConnector.
   *
   * @param \GuzzleHttp\ClientInterface $client
   *   Client interface.
   * @param \Drupal\Core\Config\ConfigFactory $config
   *   Config factory.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $error_log
   *   Error log.
   * @param \Drupal\exchange_rates\ExchangeRatesEntityService $entity_service
   *   The entity  service.
   */
  public function __construct(ClientInterface $client, ConfigFactory $config, LoggerChannelFactoryInterface $error_log, ExchangeRatesEntityService $entity_service) {
    $this->httpClient = $client;
    $this->configForm = $config;
    $this->errorLog = $error_log;
    $this->entityService = $entity_service;
  }

  /**
   * Get error message.
   *
   * @param string $message
   *   Error message.
   */
  public function getError($message) {
    $this->errorLog->get('exchange_rates')->error($message);
  }

  /**
   * Get all form settings.
   *
   * @return object
   *   Rerun config form seating.
   */
  public function getExchangeConfig() {
    return $this->configForm->get('exchange_rates.settings');
  }

  /**
   * This Function is filtered data.
   *
   * @return array
   *   Return filter data.
   */
  public function getActiveCurrency() {
    $current_rates = $this->getExchangeConfig()->get('list_course');
    return array_filter($current_rates);
  }

  /**
   * Return url from config form.
   *
   * @return mixed
   *   Return url from config form.
   */
  public function getUrlConfig() {
    return $this->getExchangeConfig()->get('api_base_url');
  }

  /**
   * Return checkbox from config form.
   *
   * @return mixed
   *   Return checkbox from config form.
   */
  public function getDisableButtonConfig() {
    return $this->getExchangeConfig()->get('disabled_api');
  }

  /**
   * Return count days from config form.
   *
   * @return mixed
   *   Return count days from config form.
   */
  public function getCoundDaysConfig() {
    return $this->getExchangeConfig()->get('count_days');
  }

  /**
   * This function generate full api request.
   *
   * @param int $count_days
   *   Counter days.
   * @param string $url
   *   Api url.
   *
   * @return string
   *   Return full api link.
   */
  public function getEndPoint($count_days, $url = NULL) {
    if ($url == NULL) {
      $url = $this->getUrlConfig();
    }
    return $url . "?json&date=" . $this->getDate($count_days);
  }

  /**
   * This function get date.
   *
   * @param int $count_days
   *   Days count.
   *
   * @return string
   *   Return date.
   */
  public function getDate($count_days) {
    return date("d.m.Y", strtotime("-$count_days day"));
  }

  /**
   * This function checked request.
   *
   * @param string $url
   *   Request url.
   *
   * @return bool
   *   Return true or false.
   */
  public function checkRequest($url) {
    try {
      $end_point = $url . "?json&date=" . date("d.m.Y");
      $this->httpClient->request('GET', $end_point)->getBody();
      return TRUE;
    }
    catch (\Exception $e) {
      $this->getError($e->getMessage());
      return FALSE;
    }
  }

  /**
   * Send request from api.
   *
   * @return array
   *   Return exchanges rates from request.
   */
  public function getExchangeRates() {
    $url = $this->getUrlConfig();
    $full_data = [];
    $disabled_request = $this->getDisableButtonConfig();
    if (!$disabled_request && $url !== '') {
      for ($i = 0; $i < $this->getCoundDaysConfig(); $i++) {
        $full_data[$i] = $this->entityService->getEntityFields($this->getActiveCurrency(), $this->getDate($i));
        if (!$this->entityService->loadEntityByDate($this->getDate($i))) {
          $data = $this->sendRequest($i);
          for ($j = 0; $j < count($data->exchangeRate); $j++) {
            $this->entityService->generateEntityLoop($data->exchangeRate[$j], $data);
          }
        }
      }
    }
    return $full_data;
  }

  /**
   * Send request to api.
   *
   * @param int $count_days
   *   Get days count.
   * @param string $url
   *   Get url from form state.
   *
   * @return array|mixed
   *   Return json from api.
   *
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function sendRequest($count_days, $url) {
    try {
      $end_point = $this->getEndPoint($count_days, $url);
      $request = $this->httpClient->request('GET', $end_point);
      $body = $request->getBody();
      return json_decode($body);
    }
    catch (\Exception $e) {
      $this->getError($e->getMessage());
    }
    return [];
  }

  /**
   * Return all currency name.
   *
   * @param string $url
   *   Url from form state.
   *
   * @return array
   *   Return all currency name.
   */
  public function getCurrencyName($url) {
    $data = [];
    $disabled_request = $this->getDisableButtonConfig();
    if (!$disabled_request) {
      $json = $this->sendRequest(1, $url);
      foreach ($json->exchangeRate as $key => $val) {
        $data[$val->currency] = $val->currency;
      }
    }
    return $data;
  }

}
