<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

use function Symfony\Component\Clock\now;

#[Route('/commande', name: 'app_commande_')]
final class CommandeController extends AbstractController
{
       private $rubriqueRepo;
       private $produitRepo;
       private $commandeRepo;

        public function __construct(RubriqueRepository $rubriqueRepo, ProduitRepository $produitRepo, CommandeRepository $commandeRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;
        $this->commandeRepo = $commandeRepo;

    } 

    #[Route('/add', name: 'add')]
    public function add(SessionInterface $session, ProduitRepository $produitRepo, EntityManagerInterface $em): Response
    {
        $search = "#";
        $rubriques = $this->rubriqueRepo->FindAll();

        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);

        if($panier === []) {
            $this->addFlash('message', 'votre panier est vide');
            return $this->redirectToRoute('app_acceuil');
        }

        
        $commande = new Commande();

        $commande->setRefUser($this->getUser());
        $commande->setDateAchat(new \DateTime());

        foreach($panier as $item =>$quantity){
            $Paniers = new Panier();

            $produit = $produitRepo->find($item);
            $prix = $produit->getPrix();

            $Paniers->setidproduit($produit);
            $Paniers->setprix($prix);
            $Paniers->setQuantite($quantity);

            $commande->addidpanier($Paniers);
        }

        $em->persist($commande);
        $em->flush();


            $this->addFlash('message', 'Commande créée avec succès');
            return $this->redirectToRoute('app/accueil') ;
    }

     #[Route('/index', name: 'index')]
    public function index(CommandeRepository $commandeRepo, Request $request): Response
    {
        $search = "#";
        $rubriques = $this->rubriqueRepo->FindAll();
        $user = $this->getUser();
        $Id = $user->getId();
        
        $commande = $this->commandeRepo->getSomeCommandes($Id);
        

        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
            'search' => $search,
            'rubriques' => $rubriques,
        ]);
    }
}
