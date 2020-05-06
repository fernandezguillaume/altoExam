<?php

namespace App\Form; 

use App\Entity\Produit; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionResolver\OptionResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder    
            ->add('name', TextType::class)
            ->add('quantity', NumberType::class)
            ->add('submit', SubmitType::class);

    }

    public function configureOption(OptionResolver $resolver){
        $resolver->setDefault([
            'data_class' => Produit::class
        ]);
    }

}

