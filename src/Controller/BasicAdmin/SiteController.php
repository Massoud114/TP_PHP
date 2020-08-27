<?php

namespace App\Controller\BasicAdmin;

use App\Entity\Site;
use App\Form\SiteType;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/site")
 */
class SiteController extends AbstractController
{
	/**
	 * @Route("/", name="site_index", methods={"GET"})
	 * @param SiteRepository $siteRepository
	 * @return Response
	 */
    public function index(SiteRepository $siteRepository): Response
    {
        return $this->render('site/index.html.twig', [
            'sites' => $siteRepository->findAll(),
			'active' => 'site'
        ]);
    }

	/**
	 * @Route("/new", name="site_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 */
    public function new(Request $request): Response
    {
        $site = new Site();
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($site);
            $entityManager->flush();
			$this->addFlash("success", "Site enregistré");

            return $this->redirectToRoute('site_index');
        }

        return $this->render('site/new.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
			'active' => 'site'
        ]);
    }

	/**
	 * @Route("/{id}/edit", name="site_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Site $site
	 * @return Response
	 */
    public function edit(Request $request, Site $site): Response
    {
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
			$this->addFlash("success", "Les modifications ont bien été prises en comptes !");

            return $this->redirectToRoute('site_index');
        }

        return $this->render('site/edit.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
			'active' => 'site'
        ]);
    }

	/**
	 * @Route("/{id}", name="site_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Site $site
	 * @return Response
	 */
    public function delete(Request $request, Site $site): Response
    {
        if ($this->isCsrfTokenValid('delete'.$site->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($site);
            $entityManager->flush();
        }

        return $this->redirectToRoute('site_index');
    }
}
