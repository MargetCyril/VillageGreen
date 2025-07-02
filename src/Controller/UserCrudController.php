<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserForm;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RubriqueRepository;
    
#[Route('/user/crud')]
final class UserCrudController extends AbstractController
{
    
private $rubriqueRepo;

public function __construct(RubriqueRepository $rubriqueRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
    }

    #[Route(name: 'app_user_crud_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $search = "#";
        $rubriques = $this->rubriqueRepo->FindAll();
        $user = $userRepository->findAll();

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('user_crud/index.html.twig', [
                'users' => $user,
                'search' => $search,
                'rubriques' => $rubriques,
        ]);
        } else {
            $user = $this->getUser();
            return $this->redirectToRoute('app_user_index', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }
        
    }

    #[Route('/new', name: 'app_user_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserForm::class, $user);
        $form->handleRequest($request);
        $search = "#";
        $rubriques = $this->rubriqueRepo->FindAll();


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_crud/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'search' => $search,
            'rubriques' => $rubriques,
        ]);
    }

    #[Route('/{id}', name: 'app_user_crud_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        $search = "#";
        $rubriques = $this->rubriqueRepo->FindAll();

        return $this->render('user_crud/show.html.twig', [
            'user' => $user,
            'search' => $search,
            'rubriques' => $rubriques,
        ]);
    }

    #[Route('/{id}', name: 'app_user_index', methods: ['GET'])]
    public function userindex(User $user): Response
    {
        $search = "#";
        $rubriques = $this->rubriqueRepo->FindAll();

        return $this->render('user_crud/indexperso.html.twig', [
            'user' => $user,
            'search' => $search,
            'rubriques' => $rubriques,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserForm::class, $user);
        $form->handleRequest($request);
        $search = "#";
        $rubriques = $this->rubriqueRepo->FindAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_crud/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'search' => $search,
            'rubriques' => $rubriques,
        ]);
    }

    #[Route('/{id}', name: 'app_user_crud_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
