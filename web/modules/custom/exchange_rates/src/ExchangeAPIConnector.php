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
   * Constructs an ExchangeAPIConnector.
   *
   * @param \GuzzleHttp\ClientInterface $client
   *   Client interface.
   * @param \Drupal\Core\Config\ConfigFactory $config
   *   Config factory.
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $error_log
   *   Error log.
   */
  public function __construct(ClientInterface $client, ConfigFactory $config, LoggerChannelFactoryInterface $error_log) {
    $this->httpClient = $client;
    $this->configForm = $config;
    $this->errorLog = $error_log;
  }

  /**
   * Get Error message.
   *
   * @param string $message
   *   Error message.
   *
   * @return void
   *   return
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
    $config_form = $this->configForm->get('exchange_rates.settings');
    return $config_form;
  }

  /**
   * This Function is filtered data.
   *
   * @param object $data
   *   All exchange rates.
   *
   * @return array
   *   Return filter data.
   */
  public function getFilterData($data) {
    try {
      $filter_data = [];
      $current_rates = $this->getExchangeConfig()->get('list_course');
      $active_currency = array_filter($current_rates, function ($item) {
        return $item !== 0;
      });
      for ($i = 0; $i < count($data); $i++) {
        if ($active_currency[$i] == $i) {
          $filter_data[$i] = $data[$i];
        }
      }
      return $filter_data;
    }
    catch (\Exception $e){
      $this->getError($e->getMessage());
    }
  }

  /**
   * Send request from api.
   *
   * @return array
   *   Return exchanges rates from request.
   */
  public function getExchangeRates() {
    $url = $this->getExchangeConfig()->get('api_base_url');
    $disabled_request = $this->getExchangeConfig()->get('disabled_api');
    if ($disabled_request == FALSE) {
      try {
        $request = $this->httpClient->request('GET', $url);
        $body = $request->getBody();
        $data = json_decode($body);
        foreach ($data as $key => $value) {
          $data = $value;
        }
        return $data;
      }
      catch (ClientException $e) {
        watchdog_exception('exchange_rate', $e, $e->getMessage());
      }
    }
  }

}
