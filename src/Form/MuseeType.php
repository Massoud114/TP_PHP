<?php

namespace App\Form;

use App\Entity\Musee;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MuseeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numMus', IntegerType::class)
            ->add('nomMus', TextType::class)
            ->add('nbLivres', IntegerType::class)
            ->add('pays', EntityType::class, [
				'class' => Pays::class,
				'choice_label' => 'codePays',
				'multiple' => false,
				'required' => false
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Musee::class,
        ]);
    }
}
