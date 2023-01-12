<?php

namespace Drupal\green_custom_sidebar\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'GreenCustomSidebar' Block.
 *
 * @Block(
 *   id = "green_custom_sidebar_block",
 *   admin_label = @Translation("Green custom sidebar block"),
 *   category = @Translation("Custom sidebar"),
 * )
 */
class GreenCustomSidebarBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    return $this->renderRegion('content_left_sidebar');

  }

  /**
   * Rendered region.
   *
   * @param string $region
   *   return region.
   *
   * @return array
   *   return view.
   */
  private function renderRegion($region) {
    $build = [];
    foreach ($this->getBlocksInRegion($region) as $block) {
      $build[] = \Drupal::entityTypeManager()
        ->getViewBuilder('block')
        ->view($block);
    }
    return $build;
  }

  /**
   * Get blocks in region.
   *
   * @param string $region
   *   return block region.
   *
   * @return array
   *   return block array.
   */
  private function getBlocksInRegion(string $region): array {
    return \Drupal::entityTypeManager()
      ->getStorage('block')
      ->loadByProperties([
        'status' => 1,
        'theme' => 'flame',
        'region' => $region,
      ]);
  }
}
