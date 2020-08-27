<?php

namespace App\Controller\Admin;

use App\Entity\Bibliotheque;
use App\Entity\Musee;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class BibliothequeCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Bibliotheque::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			// the labels used to refer to this entity in titles, buttons, etc.
			->setEntityLabelInSingular('Bibliothèque')
			->setEntityLabelInPlural('Bibliothèques')
			->setPageTitle('index', '<h3>Liste des %entity_label_plural%</h3>')
			->setPageTitle('new', '<h3>Créer une nouvelle %entity_label_singular%</h3>')
			->setPageTitle('edit', 'Editer la %entity_label_singular% %entity_id%')
			->setHelp('edit', 'Veuillez entrez les modifications que vous souhaitez apportez à la %entity_label_singular%');
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			DateTimeField::new('dateAchat', 'Date d\'achat')
				->setHelp('Date d\'achat de la bibliothèque')
				->setFormType(DateTimeType::class),
			AssociationField::new('numMus', "Musee")
				->setFormType(EntityType::class)
				->setFormTypeOption('class', Musee::class)
				->setFormTypeOption('multiple', false)
				->setFormTypeOption('choice_label', 'nomMus')
				->setSortable(false),
			/*CollectionField::new('ISBN', "Ouvrage")
				->setFormType(CollectionType::class)
				->setFormTypeOption('entry_type', EntityType::class)
				->setFormTypeOption('entry_options', [
					'class' => Ouvrage::class,
					'choice_label' => 'titre',
					'multiple' => false
				]),*/
			AssociationField::new('ISBN', "ouvrage")
		];
	}


	public function configureActions(Actions $actions): Actions
	{
		return $actions
			// ...
			->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
				return $action->setIcon('fa fa-file-alt')->setLabel('Nouvelle Bibliothèque');
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
