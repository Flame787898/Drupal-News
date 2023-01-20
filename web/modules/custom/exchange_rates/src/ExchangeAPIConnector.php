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
      foreach ($active_currency as $item) {
        for ($i = 0; $i < count($active_currency); $i++) {
          for ($j = 0; $j < count($data[0]); $j++) {
            if ($item == $data[$i][$j]->currency) {
              $filter_data[$i][$j] = $data[$i][$j];
            }
          }
        }
      }
      return $filter_data;
    }
    catch (\Exception $e) {
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
  public function getUrlConfig() {
    return $this->getExchangeConfig()->get('api_base_url');
  }

  /**
   *  Return checkbox from config form.
   *
   * @return mixed
   *    Return checkbox from config form.
   */
  public function getDisableButtonConfig() {
    return $this->getExchangeConfig()->get('disabled_api');
  }

  /**
   *  Return count days from config form.
   *
   * @return mixed
   *    Return count days from config form.
   */
  public function getCoundDaysConfig() {
    return $this->getExchangeConfig()->get('count_days');
  }

  /**
   * This function generate full api request.
   *
   * @return string
   *   Return full api request.
   */
  public function getEndPoint($count_days) {
    $today = $this->getDate($count_days);
    return $this->getUrlConfig() . "?json&date=$today";
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
      $today = date("d.m.Y");
      $end_point = $url . "?json&date=$today";;
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
      try {
        for ($i = 0; $i < $this->getCoundDaysConfig(); $i++) {
          $end_point = $this->getEndPoint($i);
          $request = $this->httpClient->request('GET', $end_point);
          $body = $request->getBody();
          $data[$i] = json_decode($body);
          for($j =0 ; $j< count($data[0]->exchangeRate); $j++){
            $data[$i]->exchangeRate[$j]->date = $data[$i]->date;
            $full_data[$i] = $data[$i]->exchangeRate;
          }
        }
        return $full_data;
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
   */
  public function getCurrencyName() {
    $data = [];
    $disabled_request = $this->getDisableButtonConfig();
    if (!$disabled_request) {
      $json = $this->getExchangeRates();
      foreach ($json[0] as $key => $val) {
        $key = $val->currency;
        $data[$key] = $val->currency;
      }
      return $data;
    }
    return $data;
  }

}
