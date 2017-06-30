<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 23/06/2017
 * Time: 12:38
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'constraints' => array(new NotBlank(),
                    new Length(array('min' => 2)),
                )))
            ->add('firstName', TextType::class, array(
                'constraints' => array( new NotBlank(),
                    new Length(array('min' => 2)),
                )))
            ->add('mail', EmailType::class, array(
                'constraints' => array( new Email(),
                    new NotBlank(),
                )))
            ->add('subject', TextType::class, array(
                'constraints' => array( new NotBlank(),
                    new Length(array('min' => 2)),
                )))
            ->add('message', TextareaType::class, array(
                'constraints' => array( new NotBlank(),
                    new Length(array('min' => 2)),
                )))
            ->add('envoyer', SubmitType::class)
            ->getForm();
    }
}
