<?php

namespace Sdt\MessageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MessageAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('thread')
			->add('sender')
			->add('body')
			->add('createdAt')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('thread', 'sonata_type_model')
				->add('sender', 'sonata_type_model')
				->add('body')
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('thread')
			->add('sender')
			->add('body')
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
			->add('thread', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('sender', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('body')
		;
	}
}