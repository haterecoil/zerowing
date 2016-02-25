<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FuzzingUriType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uri', TextType::class, array(
                'required' => true,
                'attr'=> array('placeholder' => '/secret/place')
            ))
            ->add('type', TextType::class, array(
                'required' => true,
                'attr'=> array('placeholder' => 'phpmyadmin')
            ))
            ->add('http_method', ChoiceType::class, array(
                'choices' => array(
                    'GET' => 'GET',
                    'POST' => 'POST',
                    'PUT' => 'PUT',
                    'DELETE' => 'DELETE',
                    'UPDATE' => 'UPDATE',
                ),
                'required' => true,
                'attr' => array('placeholder' => 'Choose an HTTP Verb')
            ))
            ->add('http_target', CollectionType::class, array(
                'type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => '__http__param',
            ))
            ->add('csrf', TextType::class, array(
                'required' => false,
                'attr' => array('placeholder' => 'If CSRF token needed, please add its field\'s name')
            ))
            ->add('match_success', TextType::class, array(
                'required' => false,
                'attr' => array('placeholder' => 'Type a regex which will check if login succeeded')
            ))
            ->add('submit', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FuzzingUri',
        ));
    }
}
