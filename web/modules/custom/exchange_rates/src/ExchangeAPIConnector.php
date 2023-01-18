<?php

namespace Drupal\exchange_rates;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

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
   * @param \GuzzleHttp\ClientInterface $client
   *   Client interface.
   * @param \Drupal\Core\Config\ConfigFactory $config
   *   Config factory.
   */
  public function __construct(ClientInterface $client, ConfigFactory $config) {
    $this->httpClient = $client;
    $this->configForm = $config;
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
