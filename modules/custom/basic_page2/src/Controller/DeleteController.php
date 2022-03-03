<?php

namespace Drupal\basic_page2\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController 
{
    public function delete_data()
    {
        $id = \Drupal::routeMatch()->getRawParameter('id');

        \Drupal::database()->delete('students')
            ->condition('id', $id)
            ->execute();
        return new Response('This record has been deleted' . $id);
    }
}
