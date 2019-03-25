<?php

namespace Lacces\LaccesBundle\Entity\Forms;


use Lacces\LaccesBundle\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class userType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
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
      ->add('password', TextType::class, array(
        'label' => "Mot de passe",
        'attr' => array(
          'maxlength' => "50",
          'class' => "formValue",
          'data-length' => "50",
          'autocomplete' => "off"
        )))
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => user::class,
    ]);
  }

}