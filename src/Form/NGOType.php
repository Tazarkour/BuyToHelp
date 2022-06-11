<?php

namespace App\Form;

use App\Entity\NGO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NGOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NGO')
            ->add('img',FileType::class, array(
                    'multiple'    => false,
                    'attr' => array(

                        'accept' => 'image/*',
                    )
                )
            )
            ->add('Description')
            ->add('Type')
            ->add("submit",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NGO::class,
        ]);
    }
}
