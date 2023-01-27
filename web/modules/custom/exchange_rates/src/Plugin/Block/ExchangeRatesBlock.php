<?php

namespace Drupal\exchange_rates\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\exchange_rates\ExchangeAPIConnector;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Displays block.
 *
 * @Block(
 *   id = "exchange_rates_block",
 *   admin_label = "Exchange rates"
 * )
 */
class ExchangeRatesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * In this variable are stored service methods.
   *
   * @var \Drupal\exchange_rates\ExchangeAPIConnector
   */
  protected $exchangeAPIConnector;

  /**
   * Constructs an ExchangeRatesBlock.
   *
   * @param array $configuration
   *   The configuration to use.
   * @param string $plugin_id
   *   The ID of the plugin.
   * @param string $plugin_definition
   *   Plugin definition.
   * @param \Drupal\exchange_rates\ExchangeAPIConnector $exchangeAPIConnector
   *   Exchange service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ExchangeAPIConnector $exchangeAPIConnector) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->exchangeAPIConnector = $exchangeAPIConnector;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('exchange_rates.api_connector')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $data = $this->exchangeAPIConnector->getExchangeRates();
    $currency = $this->exchangeAPIConnector->getActiveCurrency();
    return [
      '#theme' => 'exchange_block',
      '#data' => $data,
      '#attached' => [
        'library' => [
          'exchange_rates/exchange_rates_chart',
        ],
        'drupalSettings' => [
          'exchange_rates' => [
            'exchange_data' => $data,
            'currency_name' => $currency,
          ],
        ],
      ],
    ];
  }

}
