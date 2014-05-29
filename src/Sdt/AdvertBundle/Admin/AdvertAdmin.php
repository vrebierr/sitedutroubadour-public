<?php

namespace Sdt\AdvertBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AdvertAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('title')
			->add('message')
			->add('category')
			->add('lookingFor')
			->add('ageMin')
			->add('ageMax')
			->add('author')
			->add('locale')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('Annonce')
				->add('title')
				->add('message')
			->end()
			->with('Infos')
				->add('category', 'sonata_type_model')
				->add('lookingFor', 'sonata_type_model')
				->add('ageMin')
				->add('ageMax')
				->add('author', 'sonata_type_model')
				->add('locale')
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('title')
			->add('message')
			->add('category')
			->add('lookingFor')
			->add('ageMin')
			->add('ageMax')
			->add('author')
			->add('locale')
			->add('_action', 'actions', array(
				'actions' => array(
					'view' => array(),
					'edit' => array(),
					'delete' => array(),
				)
			))
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('title')
			->add('message')
			->add('category')
			->add('lookingFor')
			->add('ageMin')
			->add('ageMax')
			->add('author')
			->add('locale')
		;
	}
}