<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DireccionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('nombre')
            ->add('calle')
            ->add('altura')
            ->add('dpto')
            ->add('piso')
            ->add('edificio')
            ->add('barrio')
//            ->add('latitud')
//            ->add('longitud')
//            ->add('visible')
//            ->add('activo')
            ->add('localidad', null, array(
                "required" => true
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Direccion'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_direccion';
    }


}
