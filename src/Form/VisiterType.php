<?php

namespace App\Form;

use App\Entity\Musee;
use App\Entity\Visiter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbvisiteurs', IntegerType::class)
            ->add('musee', EntityType::class, [
            	'class' => Musee::class,
				'multiple' => false,
				'choice_label' => 'nomMus',
				'required' => false
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiter::class,
        ]);
    }
}
