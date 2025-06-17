<?php

namespace App\Controller;

use App\Repository\RubriqueRepository;
use App\Repository\SousRubriqueRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RubriqueController extends AbstractController
{

private $rubriqueRepo;
private $sousrubRepo;

public function __construct(RubriqueRepository $rubriqueRepo, SousRubriqueRepository $sousrubRepo)
    {
        
        $this->rubriqueRepo = $rubriqueRepo;
        $this->sousrubRepo = $sousrubRepo;
    }

    #[Route('/rubrique', name: 'app_rubrique')]
    public function rubriqueid(Request $request): Response
    {
        $search = '<form method="post" action="search.php">
                    <label for="recherche"></label>
                    <input type="text" name="recherche" id="recherche" placeholder="recherche...">
                    </form>';
        $param = $request->query->get('id');
        $rubrique = $this->rubriqueRepo->FindAll();
        $sousrubrique = $this->sousrubRepo->getSomeSousrub($param);

        return $this->render('rubrique/rubrique.html.twig', [
            'controller_name' => 'RubriqueController',
            'search' => $search,
            'rubrique' => $rubrique,
            'sousrubrique' => $sousrubrique,
        ]);
    }
}
