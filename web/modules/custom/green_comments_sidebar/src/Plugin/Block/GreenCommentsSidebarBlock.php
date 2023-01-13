<?php

namespace Drupal\green_comments_sidebar\Plugin\Block;

use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
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
   * @param string $region
   * @return array
   * @throws InvalidPluginDefinitionException
   * @throws PluginNotFoundException
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
   * @param string $region
   *
   * @return array
   * @throws InvalidPluginDefinitionException
   * @throws PluginNotFoundException
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
