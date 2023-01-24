<?php

namespace Drupal\exchange_rates;

use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Entity service.
 */
class ExchangeRatesEntityService {

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  private $entityTypeManager;

  /**
   * Initialize service constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager interface.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Get storage entity.
   *
   * @return \Drupal\Core\Entity\EntityStorageInterface
   *   Return storage.
   */
  public function getStorageEntity() {
    return $this->entityTypeManager->getStorage('exchange_rates');
  }

  /**
   * This function filtered entity by date.
   *
   * @param string $date
   *   Date from api.
   *
   * @return \Drupal\Core\Entity\EntityInterface[]
   *   Return entity.
   */
  public function loadEntityByDate($date) {
    $data = $this->getStorageEntity()
      ->loadByProperties([
        'field_date' => $date,
      ]);
    return $data;
  }

  /**
   * This function filtered entity by active currency and date.
   *
   * @param array $active_currency
   *   Active currency list.
   * @param string $date
   *   Actual date.
   *
   * @return \Drupal\Core\Entity\EntityInterface[]
   *   Return entity.
   */
  public function getEntityByCurrency(array $active_currency, string $date) {
    return $this->getStorageEntity()
      ->loadByProperties([
        'field_currency' => $active_currency,
        'field_date' => $date,
      ]);
  }

  /**
   * This function created entity.
   *
   * @param string $base_currency
   *   Base currency.
   * @param string $currency
   *   Currency.
   * @param string $sale_rate
   *   Sale rate.
   * @param string $date
   *   Date.
   */
  public function createEntityData($base_currency, $currency, $sale_rate, $date) {
    $data = $this->getStorageEntity()->create([
      'type' => 'exchange_bundle',
      'field_base_currency' => $base_currency,
      'field_currency' => $currency,
      'field_date' => $date,
      'field_sale_rate_nb' => $sale_rate,
    ]);
    $data->save();
  }

  /**
   * This function deletes entities by date.
   *
   * @param string $date
   *   Date.
   */
  public function removeEntityByDate($date) {
    $entites = $this->loadEntityByDate($date);
    $this->getStorageEntity()->delete($entites);
  }

  /**
   * This function generates entities in the loop.
   *
   * @param array|mixed $dataExchange
   *   All currencies.
   * @param array|mixed $data
   *   Date.
   */
  public function generateEntityLoop($dataExchange, $data) {
    $dataExchange->date = $data->date;
    $this->createEntityData(
      $dataExchange->baseCurrency,
      $dataExchange->currency,
      $dataExchange->saleRateNB,
      $dataExchange->date
    );
  }

  /**
   * This function get entity and generate new data.
   *
   * @param array $active_currency
   *   Currency list.
   * @param string $date
   *   Date.
   * @return array
   *   Array with new fields.
   */
  public function getEntityFields($active_currency,$date) {
    $entity =  $this->getEntityByCurrency($active_currency,$date);
    $courses = [];
    foreach ($entity as $item){
      $courses[] = [
        "baseCurrency" => $item->field_base_currency->getValue()[0]['value'],
        "currency" => $item->field_currency->getValue()[0]['value'],
        "date" => $item->field_date->getValue()[0]['value'],
        "saleRateNB" => $item->field_sale_rate_nb->getValue()[0]['value'],
      ];
    }
    return $courses;
  }

  /**
   * This function builds entities array.
   *
   * @param array $data
   *   Entity.
   *
   * @return array
   *   Return builds entities array.
   */
  public function getEntityViewBuilder(array $data) {
    $view_builder = $this->entityTypeManager->getViewBuilder('exchange_rates');
    $to_render = [];
    foreach ($data as $item) {
      foreach ($item as $element) {
        $to_render[] = $view_builder->view($element);
      }
    }
    return $to_render;
  }

}
