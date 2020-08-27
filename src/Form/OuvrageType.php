<?php

namespace App\Form;

use App\Entity\Ouvrage;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OuvrageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ISBN', IntegerType::class)
            ->add('nbPage', IntegerType::class)
            ->add('titre', TextType::class)
            ->add('pays', EntityType::class, [
            	'class' => Pays::class,
				'multiple' => false,
				'choice_label' => 'codePays',
				'required' => false
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ouvrage::class,
        ]);
    }
}
