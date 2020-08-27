<?php

namespace App\Controller\BasicAdmin;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pays")
 */
class PaysController extends AbstractController
{
	/**
	 * @Route("/", name="pays_index", methods={"GET"})
	 * @param PaysRepository $paysRepository
	 * @return Response
	 */
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('pays/index.html.twig', [
            'pays' 		=> $paysRepository->findAll(),
			'active' 	=> 'pays'
        ]);
    }

	/**
	 * @Route("/new", name="pays_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 */
    public function new(Request $request): Response
    {
        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pays);
            $entityManager->flush();
			$this->addFlash("success", "Pays enregistré");
			return $this->redirectToRoute('pays_index');
        }

        return $this->render('pays/new.html.twig', [
            'pays' 		=> $pays,
            'form' 		=> $form->createView(),
			'active' 	=> 'pays'
        ]);
    }

	/**
	 * @Route("/{id}/edit", name="pays_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Pays $pays
	 * @return Response
	 */
    public function edit(Request $request, Pays $pays): Response
    {
        $form = $this->createForm(PaysType::class, $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
			$this->addFlash("success", "Les modifications ont bien été prises en comptes !");
			return $this->redirectToRoute('pays_index');
        }

        return $this->render('pays/edit.html.twig', [
            'pays'		=> $pays,
            'form' 		=> $form->createView(),
			'active' 	=> 'pays'
        ]);
    }

	/**
	 * @Route("/{id}", name="pays_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Pays $pays
	 * @return Response
	 */
    public function delete(Request $request, Pays $pays): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pays->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pays);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pays_index');
    }
}
