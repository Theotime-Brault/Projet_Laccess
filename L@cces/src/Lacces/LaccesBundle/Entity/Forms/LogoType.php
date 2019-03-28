<?php

namespace Lacces\LaccesBundle\Entity\Forms;

use Lacces\LaccesBundle\Entity\Logo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LogoType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('image', FileType::class, array(
          'label' => false,
          'attr' => array(
              'class' => 'formValue file-path validate',
          )))
      ->add('submit', SubmitType::class, array(
          'label' => "Modifier",
          'attr' => array(
              'class' => 'btn btn-hover background-color-orange-lacces waves-effect',
          )));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Logo::class,
    ]);
  }
}