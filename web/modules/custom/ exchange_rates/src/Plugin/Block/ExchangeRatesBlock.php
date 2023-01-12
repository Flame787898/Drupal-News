<?php

namespace Drupal\exchange_rates\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Displays block
 *
 * @Block(
 *   id = "exchange_rates_block",
 *   admin_label = "Exchange rates"
 * )
 */
class ExchangeRatesBlock extends BlockBase {

  /**
   * Get all exchange rate from api
   *
   * @param $url
   *
   * @return mixed
   */
  function get_api($url): mixed {
    try {
      $client = \Drupal::httpClient();
      $get_request = $client->get($url);
    } catch (\Exception $error) {
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
    $api_url = \Drupal::config('exchange_rates.settings')->get('api_base_url');
    $allow_request = \Drupal::config('exchange_rates.settings')->get('disabled_api');
    if($allow_request == 0){
      $data = $this->get_api($api_url);
    }
    else{
      return [
        '#theme' => 'exchange-block',
        '#data' => ' ',
      ];
    }
    return [
      '#theme' => 'exchange-block',
      '#data' => $data,
    ];

  }

}