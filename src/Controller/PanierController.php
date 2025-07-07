<?php

namespace App\Controller;

use App\Entity\Produit;
use app\Repository\ProduitRepository;
use app\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panier', name: 'app_panier_')]
class PanierController extends AbstractController
{
    /*   private $rubriqueRepo;
        private $produitRepo;

        public function __construct(RubriqueRepository $rubriqueRepo, ProduitRepository $produitRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;

    } */
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        $data = [];
        $total = 0;
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session)
    {
        $id = $produit->getID();

        $panier = $session->get('panier', []);

        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');


    }
}
