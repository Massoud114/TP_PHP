<?php

namespace App\Controller\Admin;

use App\Entity\Musee;
use App\Entity\Pays;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MuseeCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Musee::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			// the labels used to refer to this entity in titles, buttons, etc.
			->setEntityLabelInSingular('Musée')
			->setEntityLabelInPlural('Musées')
			->setPageTitle('index', '<h3>Liste des %entity_label_plural%</h3>')
			->setPageTitle('new', '<h3>Créer un nouveau %entity_label_singular%</h3>')
			->setPageTitle('edit', 'Editer le Musée %entity_id%')
			->setHelp('edit', 'Veuillez entrez les modifications que vous souhaitez apportez au Musée');
	}

	public function configureFields(string $pageName): iterable
	{
		return [
			IntegerField::new('numMus', 'Numéro du Musée')
				->setSortable(false)
				->setHelp('Numéro du Musée que vous souhaitez enregistrer')
				->setFormType(IntegerType::class),
			TextField::new('nomMus', 'Nom du Musée')
				->setSortable(false)
				->setHelp('Nom du Musée que vous souhaitez enregistrer')
				->setFormType(TextType::class),
			NumberField::new('nbLivres', 'Nombre de livres')
				->setHelp("Le nombre de livres")
				->setFormType(NumberType::class),
			AssociationField::new('pays', "Pays")
				->setFormType(EntityType::class)
				->setFormTypeOption('class', Pays::class)
				->setFormTypeOption('multiple', false)
				->setFormTypeOption('choice_label', 'codePays')
				->setSortable(false)
		];
	}


	public function configureActions(Actions $actions): Actions
	{
		return $actions
			// ...
			->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
				return $action->setIcon('fa fa-file-alt')->setLabel('Nouveau Musée');
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
