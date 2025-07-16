<?php

namespace App\Controller;

use App\Repository\SousRubriqueRepository;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController  
{
    private $rubriqueRepo;
    private $produitRepo;
    private $sousrubRepo;

    public function __construct(RubriqueRepository $rubriqueRepo, ProduitRepository $produitRepo, SousRubriqueRepository $sousrubRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;
        $this->sousrubRepo = $sousrubRepo;

    }

    #[Route('/accueil', name: 'app_accueil')]
    #[Route('/', name: 'app_accueil1')]
    public function index(): Response
    {
        $produit = $this->produitRepo->findAll();
        $sousrub = $this->sousrubRepo->findAll();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'produit' => $produit,
            'sousrubrique' => $sousrub,

        ]);
    }


    public function navbar(): Response
    {
        $search = '<form method="post" action="search.php">
                    <label for="recherche"></label>
                    <input type="text" name="recherche" id="recherche" placeholder="recherche...">
                    </form>';
        $rubriques = $this->rubriqueRepo->findAll();

        return $this->render('navbar.html.twig', [
            'rubriques' => $rubriques,
            'search' => $search,

        ]);
    }

}
