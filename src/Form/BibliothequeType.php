<?php

namespace App\Form;

use App\Entity\Bibliotheque;
use App\Entity\Musee;
use App\Entity\Ouvrage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BibliothequeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAchat', DateType::class)
            ->add('numMus', EntityType::class, [
            	'class' => Musee::class,
				'multiple' => false,
				'choice_label' => 'nomMus',
				'required' => false
			])
			->add('isbn', EntityType::class, [
				'class' => Ouvrage::class,
				'multiple' => true,
				'choice_label' => 'isbn'
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bibliotheque::class,
        ]);
    }
}
