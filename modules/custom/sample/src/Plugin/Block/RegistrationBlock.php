<?php

namespace Drupal\sample\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *  id = "id_custom_block",
 *  admin_label = @Translation("registrationblockform"),
 * )
 */
class RegistrationBlock extends BlockBase implements BlockPluginInterface
{
    public function build()
    {
        $builtForm = \Drupal::formBuilder()->getForm('Drupal\sample\Form\MyForm');
        $myform['form'] = $builtForm;
        return $myform;
    }
}
