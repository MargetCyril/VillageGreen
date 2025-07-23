<?php

namespace App\Controller;

use App\Form\SearchForm;
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
        $search = $this->createForm(SearchForm::class);
        $rubriques = $this->rubriqueRepo->findAll();

        if ($search->isSubmitted() && $search->isValid()) {
            $recherche = $search->getData();
            return $this->redirectToRoute('app_search', [
                'recherche' => $recherche,
            ]);
        }

        return $this->render('navbar.html.twig', [
            'rubriques' => $rubriques,
            'search' => $search,

        ]);
    }

     #[Route('/search/{search}', name: 'app_search')]
    public function search(): Response
    {
         $produit = $this->produitRepo->search();
        $sousrub = $this->sousrubRepo->search(); 
        $rubrique = $this->rubriqueRepo->search(); 

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'produit' => $produit,
            'sousrubrique' => $sousrub,
            'rubrique' => $rubrique,

        ]);
    } 

}
