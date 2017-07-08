<?php

namespace AppBundle\Form\Type;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use AppBundle\Form\Type\TinyMCEType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DatePickerType::class)
            ->add('title', TextType::class)
            ->add('imageFile', FileType::class, array('required' => false,
                'label' => 'Ajouter / Changer d\'image',
                'attr'=>array(
                    'class'=>'custom-file')
            ))
            ->add('content', TextareaType::class, array(
                'attr' => array(
                    'class' => 'tinymce'
                )))
            ->add('enableComments', CheckboxType::class, array(
                'label'    => 'Autoriser les commentaire ?',
                'value' => null,
                'required' => false));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Article',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
