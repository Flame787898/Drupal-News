<?php

namespace Drupal\custom_paragraphs\Plugin\paragraphs\Behavior;

use Drupal\Component\Utility\Html;
use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\paragraphs\Entity\ParagraphsType;
use Drupal\paragraphs\ParagraphInterface;
use Drupal\paragraphs\ParagraphsBehaviorBase;

/**
 * Image and text paragraphs plugin.
 *
 * @ParagraphsBehavior(
 *   id = "custom_paragraphs_image_and_text",
 *   label = @Translation("Image and text settings"),
 *   description = @Translation("eatings for image and text paragraphs type."),
 *   weight = 0
 * )
 */
class ImageAndTextBehavior extends ParagraphsBehaviorBase {

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(ParagraphsType $paragraphs_type): bool {
    return $paragraphs_type->id() == "image_and_text";
  }

  /**
   * {@inheritdoc}
   */
  public function view(array &$build, Paragraph $paragraph, EntityViewDisplayInterface $display, $view_mode) {
    $bem_block = 'paragraph-' . $paragraph->bundle();
    $image_position = $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left');
    $hide_paragraph = $paragraph->getBehaviorSetting($this->getPluginId(), 'hide_mobile', 0);
    $build['#attributes']['class'][] = Html::getClass($bem_block . '--image-position-' . $image_position);
    if ($hide_paragraph == 1) {
      $build['#attributes']['class'][] = Html::getClass('hidden-mobile');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function buildBehaviorForm(ParagraphInterface $paragraph, array &$form, FormStateInterface $form_state) {

    $form['hide_mobile'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Hide mobile'),
      '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'hide_mobile', 0),
    ];

    $form['image_position'] = [
      '#type' => 'select',
      '#title' => $this->t('Image position'),
      '#description' => $this->t('Set image position'),
      '#options' => [
        'left' => $this->t('Left'),
        'right' => $this->t('Right'),
        'center' => $this->t('Center'),
      ],
      '#default_value' => $paragraph->getBehaviorSetting($this->getPluginId(), 'image_position', 'left'),
    ];
    return $form;
  }
}