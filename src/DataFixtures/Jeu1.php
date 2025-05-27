<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\User;

class Jeu1 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $rubrique1 = new Rubrique();
        
        $rubrique1->setLibelle("instrument");
        $rubrique1->setNom("Instrument");
        $rubrique1->setImage("instrument.jpg");

        $manager->persist($rubrique1);

        $sousrubrique1 = new SousRubrique();

        $sousrubrique1->setLibelle("corde");
        $sousrubrique1->setNom("Instrument à corde");
        $sousrubrique1->setImage("corde.jpg");

        $sousrubrique1->setRubrique($rubrique1);

        $manager->persist($sousrubrique1);

        $produit1 = new Produit();

        $produit1->setLibelle("luth");
        $produit1->setactif("1");
        $produit1->setdescription("un dur luth");
        $produit1->setprix("69");
        $produit1->setphoto("luth.jpg");
        $produit1->setReffournisseur("Luth-à-tion");
        $produit1->setstock("1");

        $produit1->setSousRubrique($sousrubrique1);

        $manager->persist($produit1);

        $panier1 = new Panier();

        $panier1->setquantite("1");
        $panier1->setIdProduit($produit1);
        

        $manager->persist($panier1);

        $commande1 = new Commande();

        $commande1->setPrixFinal("69");
        $commande1->setMoyenPayement("carte");
        $commande1->setTotal("69");
        $commande1->setDateAchat( new \DateTime('05/27/2025'));
        $commande1->setReduction("0");

        $commande1->addIdPanier($panier1);

        $manager->persist($commande1);

        $user1 = new User();

        $user1->setemail("testus@test.te");
        $user1->setnom("testus");
        $user1->setpassword("0000000000000000");

        $commande1->setRefUser($user1);

        $manager->persist($user1);

        $manager->flush();
    }
}
