<?php

namespace App\Controller\BasicAdmin;

use App\Entity\Visiter;
use App\Form\VisiterType;
use App\Repository\VisiterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visiter")
 */
class VisiterController extends AbstractController
{
	/**
	 * @Route("/", name="visiter_index", methods={"GET"})
	 * @param VisiterRepository $visiterRepository
	 * @return Response
	 */
	public function index(VisiterRepository $visiterRepository): Response
	{
		return $this->render('visiter/index.html.twig', [
			'visiters' => $visiterRepository->findAll(),
			'active' => 'visiter'
		]);
	}

	/**
	 * @Route("/new", name="visiter_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 */
	public function new(Request $request): Response
	{
		$visiter = new Visiter();
		$form = $this->createForm(VisiterType::class, $visiter);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($visiter);
			$entityManager->flush();
			$this->addFlash("success", "Visite enregistré");

			return $this->redirectToRoute('visiter_index');
		}

		return $this->render('visiter/new.html.twig', [
			'visiter' => $visiter,
			'form' => $form->createView(),
			'active' => 'visiter'
		]);
	}


	/**
	 * @Route("/{id}/edit", name="visiter_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Visiter $visiter
	 * @return Response
	 */
	public function edit(Request $request, Visiter $visiter): Response
	{
		$form = $this->createForm(VisiterType::class, $visiter);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->getDoctrine()->getManager()->flush();
			$this->addFlash("success", "Les modifications ont bien été prises en comptes !");

			return $this->redirectToRoute('visiter_index');
		}

		return $this->render('visiter/edit.html.twig', [
			'visiter' => $visiter,
			'form' => $form->createView(),
			'active' => 'visiter'
		]);
	}

	/**
	 * @Route("/{id}", name="visiter_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Visiter $visiter
	 * @return Response
	 */
	public function delete(Request $request, Visiter $visiter): Response
	{
		if ($this->isCsrfTokenValid('delete' . $visiter->getId(), $request->request->get('_token'))) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove($visiter);
			$entityManager->flush();
		}

		return $this->redirectToRoute('visiter_index');
	}
}
