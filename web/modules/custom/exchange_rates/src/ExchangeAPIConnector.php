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
    return [];
  }

  /**
   * Return url from config form.
   *
   * @return mixed
   *   Return url from config form.
   */
  public function getUrlConfig(){
    return  $this->getExchangeConfig()->get('api_base_url');
  }

  /**
   * Return checkbox from config form.
   *
   * @return mixed
   *    Return checkbox from config form.
   */
  public function getDisableButtonConfig(){
    return  $this->getExchangeConfig()->get('disabled_api');
  }

  /**
   * This function generate full api request.
   *
   * @return string
   *   Return full api request.
   */
  public function getEndPoint(){
    return $this->getUrlConfig() . "?json&date=" .  date("d.m.Y");
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
  public function checkRequest($url){
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
    $disabled_request = $this->getDisableButtonConfig();
    $end_point = $this->getEndPoint();
    if (!$disabled_request && $url !== '') {
      try {
        $request = $this->httpClient->request('GET', $end_point);
        $body = $request->getBody();
        $data = json_decode($body);
        foreach ($data as $key => $value) {
          $data = $value;
        }
        return $data;
      }
      catch (\Exception $e) {
        $this->getError($e->getMessage());
      }
    }
    return [];
  }

  /**
   * Return all currency name.
   *
   * @return array
   *   Return name currency.
   */
  public function getCurrencyName() {
    $data = [];
    $disabled_request = $this->getDisableButtonConfig();
    if(!$disabled_request){
      $json = $this->getExchangeRates();
      foreach ($json as $key => $val) {
        $data[$key] = $val->currency;
      }
      return $data;
    }
    return [];
  }

}
