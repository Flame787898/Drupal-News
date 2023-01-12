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
   * {@inheritdoc}
   */
  public function build() {
    $exchange_api_connector_service = \Drupal::service('exchange_rates.api_connector');

    if ($exchange_api_connector_service->allowRequest() == 0) {
      $data = $exchange_api_connector_service->getExchangeRates();
    }
    else {
      return [
        '#theme' => 'exchange-block',
        '#data' => '',
      ];
    }

    return [
      '#theme' => 'exchange-block',
      '#data' => $data,
    ];

  }

}