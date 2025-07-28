<?php

namespace App\Controller;

use App\Form\SearchForm;
use App\Repository\SousRubriqueRepository;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


    public function navbar(Request $request): Response
    {
        $rubriques = $this->rubriqueRepo->findAll();

        $searchform = $this->createForm(SearchForm::class);
        $searchform->handleRequest($request);

        if ($searchform->isSubmitted() && $searchform->isValid()) {
            $data = $searchform->getData();
            dd($data);
             return $this->redirectToRoute('app_search', [
                'data' => $data,
            ]); 
        }

        return $this->render('navbar.html.twig', [
            'rubriques' => $rubriques,
            'searchform' => $searchform,

        ]);
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request): Response
    {
        $searchform = $this->createForm(SearchForm::class);
        $searchform->handleRequest($request);

        if ($searchform->isSubmitted() && $searchform->isValid()) {
            $data = $searchform->getData();
            dd($data);
             return $this->redirectToRoute('app_search', [
                'data' => $data,
            ]); 
        }

        return $this->render('accueil/search.html.twig', [
            'controller_name' => 'AccueilController',
            'searchform' => $searchform,


        ]);
    }
}
