<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ObservationFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut', DateType::class, array(
                'widget' => 'single_text',
                'html5' => true,
                'attr' => array('class' => 'datepicker'),
                'format' => 'yyyy-MM-dd',
            ))
            ->add('fin', DateType::class, array(
                'widget' => 'single_text',
                'html5' => true,
                'attr' => array('class' => 'datepicker'),
                'format' => 'yyyy-MM-dd',
            ))
            ->add('especeFilter', CheckboxType::class, array(
                'label'    => 'Filtrer par espèce ?',
                'required' => false,
                'attr' => array('id'=> 'check-espece'),
                ))
            ->add('taxref', EntityType::class, array(
                'class' => 'AppBundle:Taxref',
                'choice_label' => 'lbnom',
                'multiple' => true,
                'required'   => false,
                'attr' => array('id'=> 'select-espece'),
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_observation_filter_type';
    }
}
