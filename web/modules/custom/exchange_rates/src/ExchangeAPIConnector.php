<?php

namespace Drupal\exchange_rates;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Queue\RequeueException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;

class ExchangeAPIConnector {

  /**
   * @var \GuzzleHttp\ClientInterface
   *   This variable send http request.
   */
  private $httpClient;

  /**
   * @var \Drupal\Core\Config\ConfigFactory
   *   This variable get config form seating.
   */
  private $configForm;

  /**
   * @param \GuzzleHttp\ClientInterface $client
   *   Client interface.
   * @param \Drupal\Core\Config\ConfigFactory $config
   *   Config factory
   */
  public function __construct(ClientInterface $client, ConfigFactory $config) {
    $this->httpClient = $client;
    $this->configForm = $config;
  }

  /**
   * @return object $config_form
   *   Rerun config form seating.
   */
  public function getExchangeConfig() {
    $config_form = $this->configForm->get('exchange_rates.settings');
    return $config_form;
  }

  /**
   * @return array $data
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
      }
      catch (ClientException $e) {
        watchdog_exception('exchange_rate', $e, $e->getMessage());
      }
      return $data;
    }
  }

}

