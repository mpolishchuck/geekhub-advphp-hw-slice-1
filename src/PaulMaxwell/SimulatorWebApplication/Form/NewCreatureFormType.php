<?php

namespace PaulMaxwell\SimulatorWebApplication\Form;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class NewCreatureFormType
 * @package PaulMaxwell\SimulatorWebApplication\Form
 *
 * Form for new creature creating
 */
class NewCreatureFormType extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('class', 'choice', array(
                'choices' => array(
                    'SphericalHorse' => 'Spherical Horse',
                    'Cat' => 'Cat',
                ),
            ))
            ->add('name', 'text', array(
                'required' => false,
            ))
            ->add('save', 'submit');
    }
}
