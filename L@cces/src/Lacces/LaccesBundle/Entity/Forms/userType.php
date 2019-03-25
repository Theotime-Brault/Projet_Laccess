<?php

namespace Lacces\LaccesBundle\Entity\Forms;


use Lacces\LaccesBundle\Entity\user;
use Symfony\Component\Form\AbstractType;
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
          'placeholder' => "test",
          'class' => "formValue",
          'data-length' => "30",
        )))
      ->add('password', TextType::class, array(
        'label' => "Mot de passe",
        'attr' => array(
          'maxlength' => "50",
          'placeholder' => "test",
          'class' => "formValue",
          'data-length' => "50",
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