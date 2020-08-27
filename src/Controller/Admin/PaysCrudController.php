<?php

namespace App\Controller\Admin;

use App\Entity\Pays;
use App\Repository\PaysRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PaysCrudController extends AbstractCrudController
{
	private $paysRepository;
	public function __construct(PaysRepository $repository)
	{
		$this->paysRepository = $repository;
	}

	public static function getEntityFqcn(): string
	{
		return Pays::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		//$pays = $this->paysRepository->find("%entity_id%")

		return $crud
			// the labels used to refer to this entity in titles, buttons, etc.
			->setEntityLabelInSingular('Pays')
			->setEntityLabelInPlural('Pays')
			->setPageTitle('index', '<h3>Liste des %entity_label_plural%</h3>')
			->setPageTitle('new', '<h3>Créer un nouveau %entity_label_singular%</h3>')
			->setPageTitle('edit', 'Editer le Pays %entity_id%')
			->setHelp('edit', 'Veuillez entrez les modifications que vous souhaitez apportez au Pays');
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			TextField::new('codePays', 'Code du Pays')
				->setSortable(false)
				->setHelp('Code du Pays que vous souhaitez enregistrer')
				->setFormType(TextType::class),
			NumberField::new('nbHabitant', 'Nombre d\'habitants')
				->setHelp("Le nombre d'habitants")
				->setFormType(NumberType::class)
		];
	}

	public function configureActions(Actions $actions): Actions
	{
		return $actions
			// ...
			->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
				return $action->setIcon('fa fa-file-alt')->setLabel('Nouveau Pays');
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
