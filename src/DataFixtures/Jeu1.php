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
        
        $rubrique1->setLibelle("instruments");
        $rubrique1->setNom("Instruments");
        $rubrique1->setImage("instrument.jpg");

        $manager->persist($rubrique1);

        $rubrique2 = new Rubrique();
        
        $rubrique2->setLibelle("accessoires");
        $rubrique2->setNom("accesoires");
        $rubrique2->setImage("accessoires.jpg");

        $manager->persist($rubrique2);

        $rubrique3 = new Rubrique();
        
        $rubrique3->setLibelle("materiel");
        $rubrique3->setNom("materiel");
        $rubrique3->setImage("materiel.jpg");

        $manager->persist($rubrique3);



        $sousrubrique1 = new SousRubrique();

        $sousrubrique1->setLibelle("corde");
        $sousrubrique1->setNom("Instrument à corde");
        $sousrubrique1->setImage("corde.jpg");

        $sousrubrique1->setRubrique($rubrique1);

        $manager->persist($sousrubrique1);

        $sousrubrique2 = new SousRubrique();

        $sousrubrique2->setLibelle("clavier");
        $sousrubrique2->setNom("Clavier");
        $sousrubrique2->setImage("clavier.jpg");

        $sousrubrique2->setRubrique($rubrique1);

        $manager->persist($sousrubrique2);

        $sousrubrique3 = new SousRubrique();

        $sousrubrique3->setLibelle("percussion");
        $sousrubrique3->setNom("Instrument à percussion");
        $sousrubrique3->setImage("percussion.jpg");

        $sousrubrique3->setRubrique($rubrique1);

        $manager->persist($sousrubrique3);

        $sousrubrique4 = new SousRubrique();

        $sousrubrique4->setLibelle("pédales");
        $sousrubrique4->setNom("pédales");
        $sousrubrique4->setImage("pedales.jpg");

        $sousrubrique4->setRubrique($rubrique2);

        $manager->persist($sousrubrique4);

        $sousrubrique5 = new SousRubrique();

        $sousrubrique5->setLibelle("lutrin");
        $sousrubrique5->setNom("lutrin");
        $sousrubrique5->setImage("lutrin.jepg");

        $sousrubrique5->setRubrique($rubrique3);

        $manager->persist($sousrubrique5);


        $produit1 = new Produit();

        $produit1->setLibelle("guitare");
        $produit1->setactif("1");
        $produit1->setdescription("instrument à cordes qui font ting ou tong");
        $produit1->setprix("250.33");
        $produit1->setphoto("GuitareClassique5.png");
        $produit1->setReffournisseur("Guy Tare");
        $produit1->setstock("1");

        $produit1->setSousRubrique($sousrubrique1);

        $manager->persist($produit1);

        $produit2 = new Produit();

        $produit2->setLibelle("piano");
        $produit2->setactif("1");
        $produit2->setdescription("instrument à clavier qui va de ding a dong");
        $produit2->setprix("595");
        $produit2->setphoto("piano.jpeg");
        $produit2->setReffournisseur("Piano Sano");
        $produit2->setstock("1");

        $produit2->setSousRubrique($sousrubrique2);

        $manager->persist($produit2);

         $produit3 = new Produit();

        $produit3->setLibelle("batterie");
        $produit3->setactif("1");
        $produit3->setdescription("instrument à percussion pour faire pudum tchii");
        $produit3->setprix("10.50");
        $produit3->setphoto("batterie.jpg");
        $produit3->setReffournisseur("Dur a Sell");
        $produit3->setstock("1");

        $produit3->setSousRubrique($sousrubrique3);

        $manager->persist($produit3);

        $produit4 = new Produit();

        $produit4->setLibelle("pédale");
        $produit4->setactif("1");
        $produit4->setdescription("accessoire pour faire des effets pas naturel");
        $produit4->setprix("1846.33");
        $produit4->setphoto("pedale.jpeg");
        $produit4->setReffournisseur("Ped Al");
        $produit4->setstock("1");

        $produit4->setSousRubrique($sousrubrique4);

        $manager->persist($produit4);

        $produit5 = new Produit();

        $produit5->setLibelle("lutrin");
        $produit5->setactif("1");
        $produit5->setdescription("meuble pour poser les partitions");
        $produit5->setprix("18.50");
        $produit5->setphoto("lutrin.jpeg");
        $produit5->setReffournisseur("Luth Rin");
        $produit5->setstock("1");

        $produit5->setSousRubrique($sousrubrique5);

        $manager->persist($produit5);


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

        $user1->setemail("admin@admin.admin");
        $user1->setnom("testus");
        $user1->setpassword('$2y$13$lqe8deptkcVxOfe3raKDhu8BVh/gumW2feCd3fEvBIKPyzLd4vX4C'); // password: admin
        $user1->setRoles(["ROLE_ADMIN"]);

        $commande1->setRefUser($user1);

        $manager->persist($user1);

        $manager->flush();
    }
}
