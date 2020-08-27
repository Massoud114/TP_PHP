<?php

namespace App\Controller\Admin;

use App\Entity\Bibliotheque;
use App\Entity\Musee;
use App\Entity\Ouvrage;
use App\Entity\Pays;
use App\Entity\Referencer;
use App\Entity\Site;
use App\Entity\Visiter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
	/**
	 * @Route("/admin", name="admin")
	 */
	public function index(): Response
	{
		$routeBuilder = $this->get(CrudUrlGenerator::class)->build();
		return $this->redirect($routeBuilder->setController(PaysCrudController::class)->generateUrl());
	}

	public function configureDashboard(): Dashboard
	{
		return Dashboard::new()
			->setTitle('CRUD Musee')
			->setTranslationDomain("fr_FR");
	}

	public function configureMenuItems(): iterable
	{
		return [
			MenuItem::linkToDashboard('Tableau de Bord', 'fa fa-home'),

			MenuItem::section('Gestion du Musée'),

			MenuItem::linkToCrud('Pays', 'fa fa-globe', Pays::class)->setCssClass("mt-3"),

			MenuItem::linkToCrud('Musée', 'fa fa-university', Musee::class)->setCssClass("mt-2"),

			MenuItem::linkToCrud('Ouvrages', 'fa fa-book', Ouvrage::class)->setCssClass("mt-2"),

			MenuItem::linkToCrud('Bibliothèques', 'fa fa-bar-chart', Bibliotheque::class)->setCssClass("mt-2"),

			MenuItem::linkToCrud('Réferencement', 'fa fa-sticky-note', Referencer::class)->setCssClass("mt-2"),

			MenuItem::linkToCrud('Sites', 'fa fa-map-marker', Site::class)->setCssClass("mt-2"),

			MenuItem::linkToCrud('Visites', 'fa fa-map', Visiter::class)->setCssClass("mt-2"),

			MenuItem::section('Autres liens')->setCssClass("mt-4"),
			MenuItem::linktoRoute("Version Classique", "fa fa-code-fork", "home"),
		];
	}

	public function configureUserMenu(UserInterface $user): UserMenu
	{
		return parent::configureUserMenu($user)
			// use this method if you don't want to display the name of the user
			->displayUserName(false)
			->displayUserAvatar(false);
	}


}
