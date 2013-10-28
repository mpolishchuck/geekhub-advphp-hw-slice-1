<?php

namespace PaulMaxwell\SimulatorWebApplication\Form;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;

class NameNewCreatureFormType extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', 'text')
            ->add('save', 'submit');
    }
}
