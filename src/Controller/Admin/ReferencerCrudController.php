<?php

namespace App\Controller\Admin;

use App\Entity\Ouvrage;
use App\Entity\Referencer;
use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReferencerCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Referencer::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			// the labels used to refer to this entity in titles, buttons, etc.
			->setEntityLabelInSingular('Référencement')
			->setEntityLabelInPlural('Référencements')
			->setPageTitle('index', '<h3>Liste des %entity_label_plural%</h3>')
			->setPageTitle('new', '<h3>Nouveau Référencement</h3>')
			->setPageTitle('edit', 'Modifier le réfécement')
			->setHelp('edit', 'Veuillez entrez les modifications que vous souhaitez apportez au %entity_label_singular%');
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			AssociationField::new('isbn', "Ouvrage")
				->setFormType(EntityType::class)
				->setFormTypeOption('class', Ouvrage::class)
				->setFormTypeOption('multiple', false)
				->setFormTypeOption('choice_label', 'titre')
				->setSortable(false),
			IntegerField::new('numeroPage', 'Numéro de page')
				->setHelp('Numéro de page')
				->setFormType(IntegerType::class),
			AssociationField::new('site', "Site")
				->setFormType(EntityType::class)
				->setFormTypeOption('class', Site::class)
				->setFormTypeOption('multiple', true)
				->setFormTypeOption('choice_label', 'nomSite')
				->setSortable(false),
		];
	}


	public function configureActions(Actions $actions): Actions
	{
		return $actions
			// ...
			->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
				return $action->setIcon('fa fa-file-alt')->setLabel('Nouveau référencement');
			})
			->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
				return $action->setIcon('fa fa-pencil')->setLabel('Modifier')->addCssClass('btn btn-primary');
			})
			->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
				return $action->setIcon('fa fa-trash')->setLabel('Supprimer')->addCssClass('btn btn-danger text-light');
			})
			->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
				return $action->setLabel('Créer')->addCssClass('btn btn-primary');
			})
			->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
				return $action->setLabel('Créer et ajouter un autre');
			})
			->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
				return $action->setLabel('Créer et continuer');
			})
			->add(Crud::PAGE_EDIT, Action::DELETE)
			->update(Crud::PAGE_EDIT, Action::DELETE, function (Action $action) {
				return $action->setIcon('fa fa-trash')->setLabel('Supprimer')->addCssClass('btn btn-danger text-light');
			});
	}
}
