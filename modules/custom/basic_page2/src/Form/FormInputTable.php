<?php

namespace Drupal\basic_page2\Form;

use Drupal\Core\Link;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

class FormInputTable extends FormBase
{

    public function getFormId()
    {
        return 'tradesteps_form_input_table';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $header_table = array(
            'id' => ('SrNo'),
            'name' => ('Name'),
            'email' => ('Email'),
            'phone' => ('Phone'),
            'address' => ('address'),
            'opt' => ('Delete Operation'),
            'opt1' => ('Edit Operation'),
        );


        $query = \Drupal::database()->select('students', 'm');
        $query->fields('m', ['id', 'name', 'phone', 'email', 'address', 'phone']);
        $results = $query->execute()->fetchAll();
        $rows = array();
        foreach ($results as $data) {
            $rows[] = array(
                'id' => $data->id,
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                Link::createFromRoute($this->t('Delete'), 'basic_page2.basicPage3', ['id' => $data->id], ['absolute' => TRUE]),
                Link::createFromRoute($this->t('Edit'), 'basic_page2.basicPage', ['id' => $data->id], ['absolute' => TRUE]),
            );
        }
        //display data in site
        $form['table'] = [
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
        ];
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // Find out what was submitted.
        $values = $form_state->getValues();
    }
}
