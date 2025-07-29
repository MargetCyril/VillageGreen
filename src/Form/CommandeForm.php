<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /* ->add('prix_final') */
            ->add('moyen_payement')
            /* ->add('total')
            ->add('date_achat')
            ->add('reduction')
            ->add('ref_user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]) */
            /* ->add('adresse_livraison', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'adresse_livraison',
            ]) */
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            
        ]);
    }
}
