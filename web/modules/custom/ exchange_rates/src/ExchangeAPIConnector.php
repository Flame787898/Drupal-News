<?php

namespace Drupal\exchange_rates;

use Drupal\Core\Queue\RequeueException;

class ExchangeAPIConnector {

  private $client;

  /**
   * @param \Drupal\Core\Http\ClientFactory $client
   */
  public function __construct(\Drupal\Core\Http\ClientFactory $client) {
    $default_url = 'https://bank.gov.ua';
    $exchange_api_config = \Drupal::config('exchange_rates.settings');
    $api_url = ($exchange_api_config->get('api_base_url')) ?: $default_url;
    $this->client = $client->fromOptions(
      [
        'base_uri' => $api_url,
      ]
    );
  }

  /**
   * Get value from checkbox 1 or 0
   *
   * @return array|int|mixed|null
   */
  public function allowRequest() {
    $exchange_api_config = \Drupal::config('exchange_rates.settings');
    return ($exchange_api_config->get('disabled_api')) ?: 0;
  }

  /**
   * Get all exchange rates from api
   *
   * @return array|mixed
   */
  public function getExchangeRates() {
    $data = [];
    $endpoint = '/NBUStatService/v1/statdirectory/exchangenew?json';
    try {
      $request = $this->client->get($endpoint);
      $result = $request->getBody()->getContents();
      $data = json_decode($result);
    } catch (RequeueException $e) {
      watchdog_exception('exchange_rate', $e, $e->getMessage());
    }
    return $data;
  }

}