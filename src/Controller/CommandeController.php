<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/commande', name: 'app_commande_')]
final class CommandeController extends AbstractController
{
       private $rubriqueRepo;
       private $produitRepo;

        public function __construct(RubriqueRepository $rubriqueRepo, ProduitRepository $produitRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;

    } 

    #[Route('/add', name: 'add')]
    public function add(SessionInterface $session): Response
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
        foreach($panier as $item =>$quantity){
            $Paniers = new Panier();

        }

        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'search' => $search,
            'rubriques' => $rubriques,
        ]);
    }
}
