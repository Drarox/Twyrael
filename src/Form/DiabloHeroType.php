<?php

namespace App\Form;

use App\Entity\HeroDiablo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiabloHeroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('BattleTag')
            ->add('Parangon')
            ->add('ParaSaison')
            ->add('Kills')
            ->add('Elites')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HeroDiablo::class,
        ]);
    }
}
