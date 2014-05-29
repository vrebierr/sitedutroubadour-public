<?php

namespace Sdt\MessageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ThreadAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('subject')
			->add('participants')
			->add('createdBy')
			->add('createdAt')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('subject')
				->add('createdBy', 'sonata_type_model')
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('subject')
			->add('participants')
			->add('createdBy')
			->add('createdAt')
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
			->add('subject')
			->add('participants', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('createdBy', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
		;
	}
}