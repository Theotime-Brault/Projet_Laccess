<?php
/**
 * Created by PhpStorm.
 * User: flo
 * Date: 07/02/19
 * Time: 14:51
 */

namespace Lacces\LaccesBundle\Entity\Forms;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FormExRefomSign extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class, [
                'label'=> 'Question',
                'autocomplete' => "off"
            ])
            ->add('solution', TextType::class, [
                'label'=> 'Solution',
                'autocomplete' => "off"
            ]);
    }

}