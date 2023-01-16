<?php

namespace Drupal\exchange_rates\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Displays block.
 *
 * @Block(
 *   id = "exchange_rates_block",
 *   admin_label = "Exchange rates"
 * )
 */
class ExchangeRatesBlock extends BlockBase {

  /**
   * Get all exchange rate from api.
   *
   * @param string $url
   *   Get url.
   *
   * @return array
   *   Get json data.
   */
  public function getApi($url) {
    try {
      $client = \Drupal::httpClient();
      $get_request = $client->get($url);
    }
    catch (\Exception $error) {
      $logger = \Drupal::logger('HTTP Client error');
      $logger->error($error->getMessage());
    }
    $data = json_decode($get_request->getBody());
    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $url = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchangenew?json';
    $data = $this->get_api($url);
    return [
      '#theme' => 'exchange-block',
      '#data' => $data,
    ];
  }

}
