<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\SousRubrique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('actif')
            ->add('description')
            ->add('prix')
            ->add('photo')
            ->add('ref_fournisseur')
            ->add('stock')
            ->add('sousRubrique', EntityType::class, [
                'class' => SousRubrique::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
