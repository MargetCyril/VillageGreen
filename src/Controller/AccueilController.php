<?php

namespace App\Controller;

use App\Form\SearchForm;
use App\Repository\SousRubriqueRepository;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
    private $rubriqueRepo;
    private $produitRepo;
    private $sousrubRepo;
    protected $requestStack;

    public function __construct(RubriqueRepository $rubriqueRepo, ProduitRepository $produitRepo, SousRubriqueRepository $sousrubRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;
        $this->sousrubRepo = $sousrubRepo;
    }

    #[Route('/accueil', name: 'app_accueil', methods: ['GET', 'POST'])]
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


    public function navbar(Request $request, RequestStack $requestStack): Response
    {
        $rubriques = $this->rubriqueRepo->findAll();

        $request = $requestStack->getCurrentRequest();
        $searchform = $this->createForm(SearchForm::class);
        $searchform->handleRequest($request);

       //requeststack in embedded controller
        
       
        return $this->render('navbar.html.twig', [
            'rubriques' => $rubriques,
            'searchform' => $searchform,

        ]);
        
        if ($searchform->isSubmitted() && $searchform->isValid()) {
            $data = $searchform->getData();
            
             return $this->redirectToRoute("{{ path('app_search', {data: $data}) }}", [
                'data' => $data
             ]);
            }

    }

    #[Route('/search/{data}', name: 'app_search', methods: ['GET', 'POST'])]
    public function search(Request $request): Response
    {
        $param = $request->get('data');
       $produit = $this->produitRepo->getSome($param); 
        // dd($param);
       /*  $sousrub = $this->sousrubRepo->findSome($param);
        $rub = $this->rubriqueRepo->findSome($param);  */

        return $this->render('accueil/search.html.twig', [
            'controller_name' => 'AccueilController',
            'data' => $param,
            'produit' => $produit,
           /*  'sousrub' => $sousrub,
            'rubrique' => $rub,
 */

        ]);
    }
}
