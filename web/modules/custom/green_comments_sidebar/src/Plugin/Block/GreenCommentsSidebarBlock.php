<?php

namespace Drupal\green_comments_sidebar\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'GreenCustomSidebar' Block.
 *
 * @Block(
 *   id = "green_comments_sidebar_block",
 *   admin_label = @Translation("Green comments sidebar block"),
 *   category = @Translation("Custom sidebar"),
 * )
 */
class GreenCommentsSidebarBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return $this->renderRegion('comments_sidebar');
  }

  /**
   * Function is rendered region.
   *
   * @param string $region
   *   get region.
   *
   * @return array
   *   get block.
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
   * Function get block in regin.
   *
   * @param string $region
   *   get region.
   *
   * @return array
   *   get array.
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
