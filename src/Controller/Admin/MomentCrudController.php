<?php

namespace App\Controller\Admin;

use App\Entity\Moment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MomentCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Moment::class;
	}

	/*
	public function configureFields(string $pageName): iterable
	{
		return [
			IdField::new('id'),
			TextField::new('title'),
			TextEditorField::new('description'),
		];
	}
	*/
}
