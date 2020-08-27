<?php

namespace App\Controller\BasicAdmin;

use App\Entity\Moment;
use App\Form\MomentType;
use App\Repository\MomentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/moment")
 */
class MomentController extends AbstractController
{
	/**
	 * @Route("/", name="moment_index", methods={"GET"})
	 * @param MomentRepository $momentRepository
	 * @return Response
	 */
    public function index(MomentRepository $momentRepository): Response
    {
        return $this->render('moment/index.html.twig', [
            'moments' => $momentRepository->findAll(),
			'active' => 'moment'
        ]);
    }

	/**
	 * @Route("/new", name="moment_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 */
    public function new(Request $request): Response
    {
        $moment = new Moment();
        $form = $this->createForm(MomentType::class, $moment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($moment);
            $entityManager->flush();

            return $this->redirectToRoute('moment_index');
        }

        return $this->render('moment/new.html.twig', [
            'moment' => $moment,
            'form' => $form->createView(),
			'active' => 'moment'
        ]);
    }


	/**
	 * @Route("/{id}/edit", name="moment_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Moment $moment
	 * @return Response
	 */
    public function edit(Request $request, Moment $moment): Response
    {
        $form = $this->createForm(MomentType::class, $moment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moment_index');
        }

        return $this->render('moment/edit.html.twig', [
            'moment' => $moment,
            'form' => $form->createView(),
			'active' => 'moment'
        ]);
    }

	/**
	 * @Route("/{id}", name="moment_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Moment $moment
	 * @return Response
	 */
    public function delete(Request $request, Moment $moment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($moment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('moment_index');
    }
}
