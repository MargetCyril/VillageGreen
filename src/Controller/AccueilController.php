<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController  
{
    private $rubriqueRepo;
    private $produitRepo;

    public function __construct(RubriqueRepository $rubriqueRepo, ProduitRepository $produitRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;

    }

    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        $search = '<form method="post" action="search.php">
                    <label for="recherche"></label>
                    <input type="text" name="recherche" id="recherche" placeholder="recherche...">
                    </form>';
        $rubrique = $this->rubriqueRepo->findAll();
        $produit = $this ->produitRepo->findAll();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'rubrique' => $rubrique,
            'search' => $search,
            'produit' => $produit,

            

        ]);
    }
}
