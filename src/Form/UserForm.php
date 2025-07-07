<?php

namespace App\Form;

use App\Entity\Commercial;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'expanded' =>true,
                'multiple' =>true,
                'choices'  => [
                    'Admin' => "ROLE_ADMIN",
                    'Utilisateur' => 'ROLE_USER',
                ]])
            ->add('password', HiddenType::class,)
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
