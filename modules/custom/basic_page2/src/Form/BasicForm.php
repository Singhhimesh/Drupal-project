<?php

namespace Drupal\basic_page2\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;


class BasicForm extends FormBase
{


    public function getFormId()
    {
        return 'ex82_hello_form';
    }



    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $conn = Database::getConnection();
        $record = array();
        if (isset($_GET['id'])) {
            $query = $conn->select('students', 'm')
                ->condition('id', $_GET['id'])
                ->fields('m');
            $record = $query->execute()->fetchAssoc();
        }

        $conn = Database::getConnection();
        $record = array();
        if (isset($_GET['id'])) {
            $query = $conn->select('students', 'm')
                ->condition('id', $_GET['id'])
                ->fields('m');
            $record = $query->execute()->fetchAssoc();
        }

        $form['description'] = [
            '#type' => 'item',
            '#title' => $this->t('Registration form'),
        ];
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Student Name'),
            '#maxlength' => 64,
            '#default_value' => (isset($record['name']) && $_GET['id']) ? $record['name'] : '',
            '#size' => 64,
        ];
        $form['phone'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Phone'),
            '#maxlength' => 64,
            '#default_value' => (isset($record['phone']) && $_GET['id']) ? $record['phone'] : '',
            '#size' => 64,
        ];  
        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email Address'),
            '#default_value' => (isset($record['email']) && $_GET['id']) ? $record['email'] : '',
            '#maxlength' => 255,
            '#size' => 64,
        ];
        $form['address'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Address'),
            '#default_value' => (isset($record['address']) && $_GET['id']) ? $record['address'] : '',
            '#maxlength' => 255,
            '#size' => 64,
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }


    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state);

        $title = $form_state->getValue('name');
        $phone = $form_state->getValue('phone');
        if (strlen($title) < 10) {
            $form_state->setErrorByName('title', $this->t('The title must be at least 10 characters long.'));
        }
        if (strlen($phone) < 10) {
            $form_state->setErrorByName('accept', $this->t('Plase enter your correct number'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $field = $form_state->getValues();
        $name = $field['name'];
        $phone = $field['phone'];
        $address = $field['address'];
        $email = $field['email'];

        $field_arr = [
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'phone' => $phone
        ];


        if (isset($_GET['id'])) {
            $field  = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone
            );
            $query = \Drupal::database();
            $query->update('students')
                ->fields($field)
                ->condition('id', $_GET['id'])
                ->execute();
            $response = new RedirectResponse("form_input_table");
            $response->send();
        } else {

            $query = \Drupal::database();
            $query->insert('students')->fields($field_arr)->execute();
            $response = new RedirectResponse("form_input_table");
            $response->send();
        }
    }
}
