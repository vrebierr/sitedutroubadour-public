<?php

namespace Sdt\AdvertBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AdvertCategoryAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('name')
			->add('description')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('name')
				->add('description')
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('name')
			->add('description')
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
			->add('name')
			->add('description')
		;
	}
}