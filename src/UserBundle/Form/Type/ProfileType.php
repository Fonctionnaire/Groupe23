<?php

namespace UserBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('username', null, array('label' => 'Pseudo'))
            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'email'))
            ->add('codePostal', TextType::class)
            ->add('town', TextType::class)
            ->add('birthDate', BirthdayType::class, array(
                'format' =>'ddMMyyyy'))
            ->add('phone', TextType::class, array('required' => false))
            ->add('avatarFile', FileType::class, array('required' => false,
                'label' => 'Avatar :',
                'attr'=>array(
                    'class'=>'custom-file')
            ))
            ->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
                'label' => 'Mot de passe actuel*',
                'translation_domain' => 'FOSUserBundle',
                'mapped' => false,
            ));
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'user_profile';
    }


    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}
