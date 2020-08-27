<?php

namespace App\Controller\BasicAdmin;

use App\Entity\Bibliotheque;
use App\Form\BibliothequeType;
use App\Repository\BibliothequeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bibliotheque")
 */
class BibliothequeController extends AbstractController
{
	/**
	 * @Route("/", name="bibliotheque_index", methods={"GET"})
	 * @param BibliothequeRepository $bibliothequeRepository
	 * @return Response
	 */
    public function index(BibliothequeRepository $bibliothequeRepository): Response
    {
        return $this->render('bibliotheque/index.html.twig', [
            'bibliotheques' => $bibliothequeRepository->findAll(),
			'active' => 'bibliotheque'
        ]);
    }

	/**
	 * @Route("/new", name="bibliotheque_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 */
    public function new(Request $request): Response
    {
        $bibliotheque = new Bibliotheque();
        $form = $this->createForm(BibliothequeType::class, $bibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bibliotheque);
            $entityManager->flush();
			$this->addFlash("success", "Bibiothèque enregistré");
			return $this->redirectToRoute('bibliotheque_index');
        }

        return $this->render('bibliotheque/new.html.twig', [
            'bibliotheque' => $bibliotheque,
            'form' => $form->createView(),
			'active' => 'bibliotheque'
        ]);
    }


	/**
	 * @Route("/{id}/edit", name="bibliotheque_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Bibliotheque $bibliotheque
	 * @return Response
	 */
    public function edit(Request $request, Bibliotheque $bibliotheque): Response
    {
        $form = $this->createForm(BibliothequeType::class, $bibliotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
			$this->addFlash("success", "Les modifications ont bien été prises en comptes !");

            return $this->redirectToRoute('bibliotheque_index');
        }

        return $this->render('bibliotheque/edit.html.twig', [
            'bibliotheque' => $bibliotheque,
            'form' => $form->createView(),
			'active' => 'bibliotheque'
        ]);
    }

	/**
	 * @Route("/{id}", name="bibliotheque_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Bibliotheque $bibliotheque
	 * @return Response
	 */
    public function delete(Request $request, Bibliotheque $bibliotheque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bibliotheque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bibliotheque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bibliotheque_index');
    }
}
