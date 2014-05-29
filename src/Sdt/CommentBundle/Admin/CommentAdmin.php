<?php

namespace Sdt\CommentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CommentAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('thread')
			->add('author')
			->add('state')
			->add('score')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('thread')
				->add('author', 'sonata_type_model')
				->add('state')
				->add('score')
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('thread')
			->add('author')
			->add('state')
			->add('score')
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
			->add('state')
			->add('score')
			->add('thread', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('author', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
		;
	}
}