<?php

namespace App\Controller\BasicAdmin;

use App\Entity\Ouvrage;
use App\Form\OuvrageType;
use App\Repository\OuvrageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ouvrage")
 */
class OuvrageController extends AbstractController
{
	/**
	 * @Route("/", name="ouvrage_index", methods={"GET"})
	 * @param OuvrageRepository $ouvrageRepository
	 * @return Response
	 */
    public function index(OuvrageRepository $ouvrageRepository): Response
    {
        return $this->render('ouvrage/index.html.twig', [
            'ouvrages' => $ouvrageRepository->findAll(),
			'active' => 'ouvrage'
        ]);
    }

	/**
	 * @Route("/new", name="ouvrage_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 */
    public function new(Request $request): Response
    {
        $ouvrage = new Ouvrage();
        $form = $this->createForm(OuvrageType::class, $ouvrage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ouvrage);
            $entityManager->flush();
			$this->addFlash("success", "Ouvrage enregistré");

            return $this->redirectToRoute('ouvrage_index');
        }

        return $this->render('ouvrage/new.html.twig', [
            'ouvrage' => $ouvrage,
            'form' => $form->createView(),
			'active' => 'ouvrage'
        ]);
    }


	/**
	 * @Route("/{id}/edit", name="ouvrage_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Ouvrage $ouvrage
	 * @return Response
	 */
    public function edit(Request $request, Ouvrage $ouvrage): Response
    {
        $form = $this->createForm(OuvrageType::class, $ouvrage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
			$this->addFlash("success", "Les modifications ont bien été prises en comptes !");

            return $this->redirectToRoute('ouvrage_index');
        }

        return $this->render('ouvrage/edit.html.twig', [
            'ouvrage' => $ouvrage,
            'form' => $form->createView(),
			'active' => 'ouvrage'
        ]);
    }

	/**
	 * @Route("/{id}", name="ouvrage_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Ouvrage $ouvrage
	 * @return Response
	 */
    public function delete(Request $request, Ouvrage $ouvrage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ouvrage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ouvrage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ouvrage_index');
    }
}
