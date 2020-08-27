<?php

namespace App\Controller\BasicAdmin;

use App\Entity\Referencer;
use App\Form\ReferencerType;
use App\Repository\ReferencerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/referencer")
 */
class ReferencerController extends AbstractController
{
	/**
	 * @Route("/", name="referencer_index", methods={"GET"})
	 * @param ReferencerRepository $referencerRepository
	 * @return Response
	 */
    public function index(ReferencerRepository $referencerRepository): Response
    {
        return $this->render('referencer/index.html.twig', [
            'referencers' => $referencerRepository->findAll(),
			'active' => 'referencer'
        ]);
    }

	/**
	 * @Route("/new", name="referencer_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 */
    public function new(Request $request): Response
    {
        $referencer = new Referencer();
        $form = $this->createForm(ReferencerType::class, $referencer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($referencer);
            $entityManager->flush();
			$this->addFlash("success", "Référencement enregistré");

            return $this->redirectToRoute('referencer_index');
        }

        return $this->render('referencer/new.html.twig', [
            'referencer' => $referencer,
            'form' => $form->createView(),
			'active' => 'referencer'
        ]);
    }

	/**
	 * @Route("/{id}/edit", name="referencer_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Referencer $referencer
	 * @return Response
	 */
    public function edit(Request $request, Referencer $referencer): Response
    {
        $form = $this->createForm(ReferencerType::class, $referencer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('referencer_index');
        }

        return $this->render('referencer/edit.html.twig', [
            'referencer' => $referencer,
            'form' => $form->createView(),
			'active' => 'referencer'
        ]);
    }

	/**
	 * @Route("/{id}", name="referencer_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Referencer $referencer
	 * @return Response
	 */
    public function delete(Request $request, Referencer $referencer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referencer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($referencer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('referencer_index');
    }
}
