<?php

namespace Drupal\sample\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;


class MyForm extends FormBase
{


    public function getFormId()
    {
        return 'registration';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['description'] = [
            '#type' => 'item',
            '#title' => $this->t('Registration form'),
        ];
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Student Name'),
            '#maxlength' => 64,
            '#size' => 64,
        ];
        $form['phone'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Phone number'),
            '#maxlength' => 64,
            '#size' => 64,
        ];
        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email Address'),
            '#maxlength' => 255,
            '#size' => 64,
        ];
        $form['address'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Address'),
            '#maxlength' => 150,
            '#size' => 64
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }


    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $name = $form_state->getValue('name');
        $phone = $form_state->getValue('phone');
        $email = $form_state->getValue('email');
        $address = $form_state->getValue('address');


        if (strlen($name) == 0) {
            $form_state->setErrorByName('name', $this->t('Name field can not be empty'));
        }
        if (strlen($phone) <= 10) {
            $form_state->setErrorByName('phone', $this->t('Please enter correct phone number'));
        }
        if (strlen($email) == 0) {
            $form_state->setErrorByName('email', $this->t('Please enter your valid email'));
        }
        if (strlen($address) ==  10) {
            $form_state->setErrorByName('address', $this->t('Please enter your valid address'));
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


        $query = \Drupal::database();
        $query->insert('student_table')->fields($field_arr)->execute();
        // $response = new RedirectResponse("form_input_table");
        // return $response->send();
    }
}
