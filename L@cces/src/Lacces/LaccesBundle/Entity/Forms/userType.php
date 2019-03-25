<?php

namespace Lacces\LaccesBundle\Entity\Forms;


use Lacces\LaccesBundle\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class userType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      //https://symfony.com/doc/4.0/doctrine/registration_form.html
    $builder
      ->add('username', TextType::class, array(
        'label' => "Nom d'utilisateur",
        'attr' => array(
          'maxlength' => "30",
          'class' => "formValue",
          'data-length' => "30",
          'autocomplete' => "off"
        )))
      ->add('email', EmailType::class, array(
        'label' => "Email",
        'attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
          'autocomplete' => "off"
        )))
        ->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe ne correspondent pas',
            'required' => true,
            'first_options'  => array(
                'label' => 'Mot de passe',
                'attr' => array(
                    'class' => 'formValue'
                )
            ),
            'second_options' => array(
                'label' => 'Confirmer le mot de passe',
                'attr' => array(
                    'class' => 'formValue'
                ),
            )
        ))
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => user::class,
    ]);
  }

}