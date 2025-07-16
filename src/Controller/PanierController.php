<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/panier', name: 'app_panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepo)
    {

        $panier = $session->get('panier', []);

        $data = [];
        $total = 0;

        foreach($panier as $id => $quantite) {
            $produit = $produitRepo->find($id);

            $data[] = [
                'produit' => $produit,
                'quantite' => $quantite,
            ];
            $total += $produit->getPrix() * $quantite;
        }
        return $this->render('panier/index.html.twig', [
            'data' => $data,
            'total' => $total
        ]);
        
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session) {
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

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session) {
        $id = $produit->getID();

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            if($panier[$id] > 1) {
            $panier[$id]--;
        } else {
            unset($panier[$id]);
        }
    }
        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');

    }
 
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produit $produit, SessionInterface $session) {
        $id = $produit->getID();

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
           unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');

    } 

    #[Route('/empty', name: 'empty')]
    public function empty (SessionInterface $session) {
        $session->remove('panier');
        return $this->redirectToRoute('app_panier_index');
    }
}
