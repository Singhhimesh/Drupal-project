<?php

namespace Drupal\basic_page2\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *  id = "id_custom_block",
 *  admin_label = @Translation("labelcustomblock"),
 * )
 */
class DefaultBlock extends BlockBase implements BlockPluginInterface
{
  public function build()
  {
    $builtForm = \Drupal::formBuilder()->getForm('Drupal\basic_page2\Form\BasicForm');
    $myform['form'] = $builtForm;
    return $myform;
  }
}
