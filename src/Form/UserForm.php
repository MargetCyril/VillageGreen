<?php

namespace App\Form;

use App\Entity\Commercial;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('siret')
            ->add('id_pro')
            ->add('adresse_livraison')
            ->add('adresse_facturation')
            ->add('ville_livraison')
            ->add('ville_facturation')
            ->add('code_postal_livraison')
            ->add('code_postal_facturation')
            ->add('ref_fournisseur')
            ->add('coeff_achat')
            ->add('commercial', EntityType::class, [
                'class' => Commercial::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
