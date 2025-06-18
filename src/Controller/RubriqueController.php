<?php

namespace App\Controller;

use App\Repository\RubriqueRepository;
use App\Repository\SousRubriqueRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RubriqueController extends AbstractController
{

private $rubriqueRepo;
private $sousrubRepo;
private $produitRepo;

public function __construct(RubriqueRepository $rubriqueRepo, SousRubriqueRepository $sousrubRepo, ProduitRepository $produitRepo)
    {
        
        $this->rubriqueRepo = $rubriqueRepo;
        $this->sousrubRepo = $sousrubRepo;
        $this->produitRepo = $produitRepo;
    }

    #[Route('/rubrique', name: 'app_rubrique')]
    public function rubriqueid(Request $request): Response
    {
        $search = '<form method="post" action="search.php">
                    <label for="recherche"></label>
                    <input type="text" name="recherche" id="recherche" placeholder="recherche...">
                    </form>';
        $param = $request->query->get('rid');
        $rubriques = $this->rubriqueRepo->FindAll();
        $sousrubrique = $this->sousrubRepo->getSomeSousrub($param);

        return $this->render('rubrique/rubrique.html.twig', [
            'controller_name' => 'RubriqueController',
            'search' => $search,
            'rubriques' => $rubriques,
            'sousrubrique' => $sousrubrique,
        ]);
    }

    #[Route('/sousrubrique', name: 'app_sousrubrique')]
    public function sousrubriqueid(Request $request): Response
    {
        $search = '<form method="post" action="search.php">
                    <label for="recherche"></label>
                    <input type="text" name="recherche" id="recherche" placeholder="recherche...">
                    </form>';
        $param = $request->query->get('srid');
        $rubriques = $this->rubriqueRepo->FindAll();
        /* $sousrubriques = $this->sousrubRepo->getAll(); */
        $produits = $this->produitRepo->getSomeProduit($param);

        return $this->render('rubrique/sousrubrique.html.twig', [
            'controller_name' => 'RubriqueController',
            'search' => $search,
            'rubriques' => $rubriques,
            /* 'sousrubrique' => $sousrubriques, */
            'produits' => $produits,
        ]);
    }
}
