<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Panier;
use App\Repository\CommandeRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

use function Symfony\Component\Clock\now;

#[Route('/commande', name: 'app_commande_')]
final class CommandeController extends AbstractController
{
       private $rubriqueRepo;

       private $commandeRepo;

        public function __construct(RubriqueRepository $rubriqueRepo, CommandeRepository $commandeRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->commandeRepo = $commandeRepo;

    } 

    #[Route('/add', name: 'add')]
    public function add(SessionInterface $session, ProduitRepository $produitRepo, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $session->get('panier', []);

        if($panier === []) {
            $this->addFlash('message', 'votre panier est vide');
            return $this->redirectToRoute('app_acceuil');
        }

        
        $commande = new Commande();

        $commande->setRefUser($this->getUser());
        $user = $this->getUser();
        $coeff = $user->getCoeffAchat();
        $commande->setDateAchat(new \DateTime());
        $total = 0;

        foreach($panier as $item =>$quantity){
            $Paniers = new Panier();

            $produit = $produitRepo->find($item);
            $prix = $produit->getPrix();
            $total = ($total + ($prix*$quantity));


            $Paniers->setidproduit($produit);
            $Paniers->setprix($prix);
            $Paniers->setQuantite($quantity);

            $commande->addidpanier($Paniers);
        }
        $commande->setPrixFinal($total);
        $total = ($total * $coeff);
        $commande->setTotal($total);

        $em->persist($commande);
        $em->flush();

        $session->remove('panier');

            $this->addFlash('message', 'Commande créée avec succès');
            return $this->redirectToRoute('app_accueil') ;
    }

     #[Route('/index', name: 'index')]
    public function index(): Response
    {
        $user = $this->getUser();
        $Id = $user->getId();
        
        $commande = $this->commandeRepo->getSomeCommandes($Id);
        

        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
        ]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detail(Commande $commande, PanierRepository $panierRepo): Response
    {
        $id = $commande->getId();
        $paniers = $panierRepo->getSome($id);
        //dd($paniers);
        

        return $this->render('commande/detail.html.twig', [
            'paniers' => $paniers,
        ]);
    }


    #[Route('/admin', name: 'admin')]
    public function admin(Commande $commande, PanierRepository $panierRepo): Response
    {

        if ($this->isGranted('ROLE_ADMIN')) {
            
            $paniers = $panierRepo->getAll();
            
            return $this->render('commande/detail.html.twig', [
                'paniers' => $paniers,

        ]);
        } 
        else {
            $user = $this->getUser();
            return $this->redirectToRoute('app_user_index', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

    }
}
