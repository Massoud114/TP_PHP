<?php

namespace App\Form;

use App\Entity\Ouvrage;
use App\Entity\Referencer;
use App\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReferencerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroPage', IntegerType::class)
            ->add('site', EntityType::class, [
            	'class' => Site::class,
				'multiple' => true,
				'choice_label' => 'nomSite'
			])
            ->add('isbn', EntityType::class, [
				'class' => Ouvrage::class,
				'multiple' => false,
				'choice_label' => 'titre'
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Referencer::class,
        ]);
    }
}
